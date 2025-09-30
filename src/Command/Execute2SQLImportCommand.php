<?php

namespace App\Command;

use App\Entity\FileExecution;
use App\Entity\FileExtract;
use App\Factory\DatabaseConnectionFactory;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use App\Service\ErrorLoggerService;
use App\Service\UploadsRoutingService;
use DateTime;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

#[AsCommand(name: 'app:import-sql-script')]
class Execute2SQLImportCommand extends Command
{
    private Connection $mainDB;
    private Connection $tmpDB;
    private string $decompressedDirectory;
    private string $exportedDirectory;

    public function __construct(
        private readonly ErrorLoggerService     $errorLogger,
        private readonly LoggerInterface        $logger,
        private readonly Filesystem             $filesystem,
        private readonly DataLoader             $dataLoader,
        private readonly EntityManagerInterface $em,
        private readonly UploadsRoutingService $uploadsRoutingService,
        DatabaseConnectionFactory               $databaseConnectionFactory,
    )
    {
        parent::__construct();
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
        $this->tmpDB = $databaseConnectionFactory->getSecondConnection();
        $this->decompressedDirectory = $this->uploadsRoutingService->getDecompressedFileUploadDirPath();
        $this->exportedDirectory = $this->uploadsRoutingService->getExportedTmpDataDirPath();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import SQL file to tmp database and export data from temporary database to main database')
            ->setHelp('app:import-sql-script => This command allows you to import SQL file to tmp database and export data from temporary database to main database')
            ->setAliases(['app:i-s-s']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $startTime = microtime(true);

        $io->text('---------------------');
        $io->text('[' . (new \DateTime())->format('Y-m-d H:i:s') . ']');
        $io->text('---------------------');

        if (!$this->mainDB instanceof Connection) {
            $errorMsq = 'Main database connection is not set !';
            $io->error($errorMsq);
            $this->errorLogger->logError(new Exception($errorMsq));

            return Command::FAILURE;
        }
        if (!$this->tmpDB instanceof Connection) {
            $errorMsq = 'Temporary database connection is not set !';
            $io->error($errorMsq);
            $this->errorLogger->logError(new Exception($errorMsq));

            return Command::FAILURE;
        }

        $extractedFiles = $this->em->getRepository(FileExtract::class)->findBy([
            'status' => FileExtract::STATUS_PENDING,
            'isDeleted' => false
        ]);

        foreach ($extractedFiles as $extractedFile) {
            $startSQLTime = microtime(true);
            $filename = $extractedFile->getFilename();
            $filePath = $this->decompressedDirectory . '/' . $filename;
            // check a file to execute
            if (!$this->filesystem->exists($filePath)) {
                $io->error("File does not exist: {$filename} in directory {$this->decompressedDirectory}");
                return Command::FAILURE;
            }
            if (!is_readable($filePath)) {
                $io->error(sprintf('File "%s" is not readable.', $filePath));
                return Command::FAILURE;
            }
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            if ($fileExtension !== 'psql') {
                $io->error('File extension must be .psql');
                return Command::FAILURE;
            }
            // Get database connection parameters from Doctrine
            $io->text("Executing import SQL file: <fg=magenta>{$filename}</> ...");;
            $now = new DateTime();
            $fileExecution = (new FileExecution())
                ->setFilename($filename)
                ->setType(FileExecution::TYPE_EXPORT)
                ->setSize(filesize($filePath) ?? 0)
                ->setSizeDescription(ByteConverter::formatBytes(filesize($filePath) ?? 0))
                ->setCreatedAt($now)
                ->setStartAt($startTime)
                ->setIsDeleted(false);
            $this->em->persist($fileExecution);

            try {
                $this->dataLoader->executePsql($filePath, DataLoader::TMP_DATABASE_NAME, FileExecution::TYPE_IMPORT);
                $extractedFile->setStatus(FileExtract::STATUS_FINISHED);
                $endSQLTime = microtime(true);
                $executionTime = $endSQLTime - $startSQLTime;
                $fileExecution->setEndAt($endSQLTime)
                    ->setExecutionTime($executionTime)
                    ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime))
                    ->setStatus(FileExecution::STATUS_SUCCESS);
                $this->em->persist($fileExecution);
                $this->em->persist($extractedFile);

            } catch (Exception $e) {
                $fileExecution->setStatus(FileExecution::STATUS_FAILED);
                $this->em->persist($fileExecution);
                $io->error('Error executed SQL file - ' . $extractedFile->getFileName());
                $this->errorLogger->logError($e, Level::Critical);
            }

            try {
                $tablesNames = $this->getTmpAllTableName();
            } catch (Exception $e) {
                $io->error('Error getting table list');;
                $this->errorLogger->logError($e, Level::Critical);

                return Command::FAILURE;
            }

            // Merging data
            $now = new DateTime();
            $timestamp = $now->getTimestamp();
            $fileExecution = (new FileExecution())
                ->setFilename($timestamp)
                ->setType(FileExecution::TYPE_EXPORT)
                ->setSize(0)
                ->setSizeDescription(0)
                ->setCreatedAt($now)
                ->setStartAt($startTime)
                ->setIsDeleted(false);
            foreach ($tablesNames as $tableName) {
                $io->text("Exporting tmp data from <fg=magenta>{$tableName}</> table ...");
                try {
                    $this->exportTmpTable($tableName, $timestamp);
                    $fileExecution->setStatus(FileExecution::STATUS_PENDING);
                } catch (Exception $e) {
                    $io->error('Error exporting data from ' . $tableName . ' table');
                    $this->errorLogger->logError($e, Level::Critical);
                    $fileExecution->setStatus(FileExecution::STATUS_FAILED);
                }
            }

            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;
            $fileExecution->setEndAt($endTime)
                ->setExecutionTime($executionTime)
                ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime));
            $this->em->persist($fileExecution);

            $this->em->flush();
        }

        $io->success('SQL file executed successfully');
        $io->text('Number of SQL executed files processed: ' . count($extractedFiles));
        $io->text('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }

    public function getTmpAllTableName(): array
    {
        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE' ORDER BY table_name";
        $result = $this->tmpDB->executeQuery($sql);

        return $result->fetchFirstColumn();
    }

    private function exportTmpTable(string $tableName, int $timestamp)
    {
        $params = $this->tmpDB->getParams();
        $host = $params['host'] ?? 'localhost';
        $port = $params['port'] ?? 5432;
        $dbname = DataLoader::TMP_DATABASE_NAME;
        $user = $params['user'];
        $password = $params['password'];

        // create a new folder has timestamp as name
        $fileSystem = new Filesystem();
        if (!$fileSystem->exists($this->exportedDirectory . '/' . $timestamp)) {
            $fileSystem->mkdir($this->exportedDirectory . '/' . $timestamp);
        }
        $outputFile = $this->exportedDirectory . '/' . $timestamp . '/' . $tableName . '.sql';

        $commandScript = [
            'pg_dump',
            '-h', $host,
            '-p', (string)$port,
            '-U', $user,
            '-t', $tableName,
            '--data-only',
            '--inserts',
            '--on-conflict-do-nothing',
            $dbname,
        ];

        $process = new Process($commandScript);
        $process->setTimeout(600);
        $env = $process->getEnv();
        $env['PGPASSWORD'] = $password;
        $process->setEnv($env);


        $this->logger->info('Executing pg_dump', [
            'database' => $dbname,
            'host' => $host,
            'port' => $port,
            'user' => $user
        ]);
        // Run the process and capture the output
        $process->run();
        // Write output to a file
        file_put_contents($outputFile, $process->getOutput());

        if ($process->isSuccessful()) {
            $this->logger->info('pg_dump completed successfully', ['exit_code' => $process->getExitCode()]);
        } else {
            $this->errorLogger->logError(new Exception('pg_dump failed'), Level::Critical);
        }
    }
}