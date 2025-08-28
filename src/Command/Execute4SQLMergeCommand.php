<?php

namespace App\Command;

use App\Entity\FileExecution;
use App\Factory\DatabaseConnectionFactory;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use DateTime;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AsCommand(name: 'app:merge-sql-script')]
class Execute4SQLMergeCommand extends Command
{
    public function __construct(
        private readonly DataLoader                $dataLoader,
        private readonly LoggerInterface           $logger,
        private readonly Filesystem                $filesystem,
        private readonly EntityManagerInterface    $em,
        private readonly string                    $targetDirectory,
        private readonly DatabaseConnectionFactory $databaseConnectionFactory,
    )
    {
        parent::__construct();
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

        foreach ($executedFiles as $executedFolder) {
            $timestamp = $executedFolder->getFilename();
            // check exported directories
            if (!$this->filesystem->exists($this->targetDirectory . '/' . $timestamp)) {
                $io->error("Exported tmp data directory does not exist: {$timestamp}");
                $this->logger->error("Exported tmp data directory does not exist: {$timestamp}");
                return Command::FAILURE;
            }

//            $io->info('Merging folder - ' . $timestamp . ' ...');
//            $files = $this->getAllExportedFiles($this->targetDirectory . '/' . $timestamp);
//            $now = new DateTime();
//            $fileExecution = (new FileExecution())
//                ->setFilename('TMP_DATABASE')
//                ->setType(FileExecution::TYPE_MERGE)
//                ->setSize(0)
//                ->setSizeDescription(0)
//                ->setCreatedAt($now)
//                ->setStartAt($startTime)
//                ->setIsDeleted(false);

//            foreach ($files as $file) {
//                $io->text("Executing SQL file: <fg=magenta>{$file['filename']}</> ...");
//                // Get database connection parameters from Doctrine
//                try {
//                    if ($file['filename'] === 'acc_person.sql') {
//                        continue;
//                    }
//                    // $this->dataLoader->executePsql($file['path'], DataLoader::DATABASE_NAME, FileExecution::TYPE_MERGE);
//                    $executedFolder->setStatus(FileExecution::STATUS_SUCCESS);
//                    $fileExecution->setStatus(FileExecution::STATUS_SUCCESS);
//                } catch (Exception $e) {
//                    $io->error('Error executing SQL file: ' . $file['filename']);
//                    $this->logger->error($e->getMessage());
//                    $fileExecution->setStatus(FileExecution::STATUS_FAILED);
//                } finally {
//                    $endTime = microtime(true);
//                    $executionTime = $endTime - $startTime;
//                    $fileExecution->setEndAt($endTime)
//                        ->setExecutionTime($executionTime)
//                        ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime));
//                    $this->em->persist($fileExecution);
//                }
//            }
            // Get acc_person from a TMP database
            if (!$this->tmpDB instanceof Connection) {
                $io->error('Temporary database connection is not set !');
                $this->logger->error("Temporary database connection is not set !");

                return Command::FAILURE;
            }
            try {
                $result = $this->getAccPersonRows();
                dump($result);
            } catch (Exception $e) {
                $io->error('Error fetching acc_person table from TMP database');
                $this->logger->error($e->getMessage());

                return Command::FAILURE;
            }
        }
        die;

        $this->em->flush();
        $io->success('Merge tmp data executed successfully');
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
     * @throws \Doctrine\DBAL\Exception
     */
    protected function getAccPersonRows(): array
    {
        $sql = "SELECT * FROM public.acc_person";
        $result = $this->tmpDB->executeQuery($sql);

        return $result->fetchAllAssociative();
    }

    protected function checkAccPersonRow(array $accPersonRow): void
    {
        $rowId = $accPersonRow['id'];
    }

}
