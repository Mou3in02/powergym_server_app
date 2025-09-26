<?php

namespace App\Command;

use AllowDynamicProperties;
use App\DTO\AccPersonDTO;
use App\Entity\FileExecution;
use App\Entity\Payment;
use App\Factory\DatabaseConnectionFactory;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use App\SQL\AccPersonSQL;
use App\utils\UsedTables;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Statement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Tests\Models\Enums\UserStatus;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AllowDynamicProperties]
#[AsCommand(name: 'app:merge-sql-script')]
class Execute3SQLMergeCommand extends Command
{
    public function __construct(
        private readonly DataLoader             $dataLoader,
        private readonly LoggerInterface        $logger,
        private readonly Filesystem             $filesystem,
        private readonly EntityManagerInterface $em,
        private readonly string                 $exportedDirectory,
        DatabaseConnectionFactory               $databaseConnectionFactory,
    )
    {
        parent::__construct();
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
        $this->tmpDB = $databaseConnectionFactory->getSecondConnection();
    }

    protected function configure()
    {
        $this
            ->setDescription('Merge tmp data from exported_tmp_data directory to main database')
            ->setHelp('app:merge-sql-script => This command allows you to merge data from temporary directory to main database')
            ->setAliases(['app:m-s-s']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $startTime = microtime(true);

        $executedFiles = $this->em->getRepository(FileExecution::class)->findBy([
            'type' => FileExecution::TYPE_EXPORT,
            'status' => FileExecution::STATUS_PENDING,
            'isDeleted' => false
        ]);

        $nbRowInsert = $nbRowUpdate = $nbRowNotChanged = $nbPayementCreated = 0;

        foreach ($executedFiles as $executedFolder) {
            $timestamp = $executedFolder->getFilename();
            // check exported directories
            if (!$this->filesystem->exists($this->exportedDirectory . '/' . $timestamp)) {
                $io->error("Exported tmp data directory does not exist: {$timestamp}");
                $this->logger->error("Exported tmp data directory does not exist: {$timestamp}");

                return Command::FAILURE;
            }

            $io->info('Merging folder - ' . $timestamp . ' ...');
            $files = $this->getAllExportedFiles($this->exportedDirectory . '/' . $timestamp);
            $now = new \DateTime();
            $fileExecution = (new FileExecution())
                ->setFilename('TMP_DATABASE')
                ->setType(FileExecution::TYPE_MERGE)
                ->setSize(0)
                ->setSizeDescription(0)
                ->setCreatedAt($now)
                ->setStartAt($startTime)
                ->setIsDeleted(false);


            foreach ($files as $file) {
                // Skip unused tables
                $tableName = explode('.', $file['filename'])[0];
                if (!in_array($tableName, UsedTables::all(), true) || $tableName === UsedTables::TABLE_ACC_PERSON) {
                    continue;
                }
                $io->text("Executing SQL file: <fg=magenta>{$file['filename']}</> ...");
                try {
                    $this->dataLoader->executePsql($file['path'], DataLoader::DATABASE_NAME, FileExecution::TYPE_MERGE);
                    $executedFolder->setStatus(FileExecution::STATUS_SUCCESS);
                    $fileExecution->setStatus(FileExecution::STATUS_SUCCESS);
                } catch (Exception $e) {
                    $io->error('Error executing SQL file: ' . $file['filename']);
                    $this->logger->error($e->getMessage());
                    $fileExecution->setStatus(FileExecution::STATUS_FAILED);
                } finally {
                    $endTime = microtime(true);
                    $executionTime = $endTime - $startTime;
                    $fileExecution->setEndAt($endTime)
                        ->setExecutionTime($executionTime)
                        ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime));
                    $this->em->persist($fileExecution);
                }
            }
            // Get acc_person from a TMP database
            if (!$this->tmpDB instanceof Connection) {
                $io->error('Temporary database connection is not set !');
                $this->logger->error("Temporary database connection is not set !");

                return Command::FAILURE;
            }

            try {
                // Main DB
                $mainAccPerson = $this->getAccPersonIdAndDates();
                $existIds = array_keys($mainAccPerson);
                // TMP DB
                $result = $this->getAccPersonRows();
            } catch (Exception $e) {
                $io->error('Error fetching acc_person table from TMP database');
                $this->logger->error($e->getMessage());

                return Command::FAILURE;
            }

            foreach ($result as $row) {
                if (!in_array($row->id, $existIds, true)) {
                    $this->insertAccPersonRow($row);
                    $this->createNewPayment($row, $nbPayementCreated);
                    $nbRowInsert++;
                } elseif ($row->startTime !== $mainAccPerson[$row->id]['start_time'] || $row->endTime !== $mainAccPerson[$row->id]['end_time']) {
                    $this->updateAccPersonRow($row);
                    $this->createNewPayment($row, $nbPayementCreated);
                    $nbRowUpdate++;
                } else {
                    $nbRowNotChanged++;
                }
            }
        }

        $this->em->flush();

        $io->success('Merge tmp data executed successfully');
        $io->text('Nb acc_person row inserted: ' . $nbRowInsert);
        $io->text('Nb acc_person row updated: ' . $nbRowUpdate);
        $io->text('Nb acc_person row not changed: ' . $nbRowNotChanged);
        $io->text('Nb payment created: ' . $nbPayementCreated);
        $io->info('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }

    protected function getAllExportedFiles(string $directory): array
    {
        $finder = new Finder();
        $finder->files()->in($directory);
        $data = [];
        foreach ($finder as $file) {
            $data[] = [
                'filename' => $file->getFilename(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
            ];
        }
        return $data;
    }

    /**
     * @return AccPersonDTO[]
     * @throws \Doctrine\DBAL\Exception
     */
    protected function getAccPersonRows(): array
    {
        $sql = AccPersonSQL::getAllAccPerson();
        $result = $this->tmpDB->executeQuery($sql);

        $data = $result->fetchAllAssociative();
        $formatData = [];
        foreach ($data as $row) {
            $formatData[] = AccPersonDTO::fromArray($row);
        }

        return $formatData;
    }

    /**
     * @return string[]
     * @throws \Doctrine\DBAL\Exception
     */
    protected function getAccPersonIdAndDates(): array
    {
        $sql = AccPersonSQL::getAccPersonIdAndDates();
        $result = $this->mainDB->executeQuery($sql);
        $data = $result->fetchAllAssociative();
        $formatData = [];
        foreach ($data as $row) {
            $formatData[$row['id']] = [
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
            ];
        }

        return $formatData;
    }

    protected function updateAccPersonRow(AccPersonDTO $accPersonRow): void
    {
        $stmt = $this->mainDB->prepare(AccPersonSQL::updateAccPerson());
        $stmt = $this->setAccPersonRow($stmt, $accPersonRow);
        $stmt->executeQuery();
    }

    protected function insertAccPersonRow(AccPersonDTO $accPersonRow): void
    {
        $stmt = $this->mainDB->prepare(AccPersonSQL::insertNewAccPerson());
        $stmt = $this->setAccPersonRow($stmt, $accPersonRow);
        $stmt->executeQuery();
    }

    protected function setAccPersonRow(Statement $stmt, AccPersonDTO $accPersonRow)
    {
        $stmt->bindValue('id', $accPersonRow->id);
        $stmt->bindValue('app_id', $accPersonRow->appId);
        $stmt->bindValue('bio_tbl_id', $accPersonRow->bioTblId);
        $stmt->bindValue('company_id', $accPersonRow->companyId);
        $stmt->bindValue('create_time', $accPersonRow->createTime);
        $stmt->bindValue('creater_code', $accPersonRow->createrCode);
        $stmt->bindValue('creater_id', $accPersonRow->createrId);
        $stmt->bindValue('creater_name', $accPersonRow->createrName);
        $stmt->bindValue('op_version', $accPersonRow->opVersion);
        $stmt->bindValue('update_time', $accPersonRow->updateTime);
        $stmt->bindValue('updater_code', $accPersonRow->updaterCode);
        $stmt->bindValue('updater_id', $accPersonRow->updaterId);
        $stmt->bindValue('updater_name', $accPersonRow->updaterName);
        $stmt->bindValue('delay_passage', $accPersonRow->delayPassage ? 1 : 0, ParameterType::BOOLEAN);
        $stmt->bindValue('disabled', $accPersonRow->disabled ? 1 : 0, ParameterType::BOOLEAN);
        $stmt->bindValue('end_time', $accPersonRow->endTime);
        $stmt->bindValue('is_set_valid_time', $accPersonRow->isSetValidTime ? 1 : 0, ParameterType::BOOLEAN);
        $stmt->bindValue('pers_person_id', $accPersonRow->persPersonId);
        $stmt->bindValue('privilege', $accPersonRow->privilege);
        $stmt->bindValue('start_time', $accPersonRow->startTime);
        $stmt->bindValue('super_auth', $accPersonRow->superAuth);

        return $stmt;
    }

    protected function createNewPayment(AccPersonDTO $accPersonRow, int &$nbPayementCreated): void
    {
        $startTime = $accPersonRow->startTime;
        $endTime = $accPersonRow->endTime;
        if (empty($startTime) || empty($endTime)) {
            return;
        }

        $startTime = (new \DateTime($startTime));
        $endTime = (new \DateTime($endTime));
        $inscriptionDays = $endTime->diff($startTime)->days;

        $updateTime = (new \DateTime($accPersonRow->updateTime));
        $createTime = (new \DateTime($accPersonRow->createTime));

        $newPayment = (new Payment())
            ->setExternalId($accPersonRow->id)
            ->setPersPersonId($accPersonRow->persPersonId)
            ->setCreateTime($createTime)
            ->setUpdateTime($updateTime)
            ->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setDays($inscriptionDays)
            ->setPrice(0)
            ->setIsDeleted(false);

        $this->em->persist($newPayment);
        $nbPayementCreated++;
    }

}
