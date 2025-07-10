<?php

namespace App\Commands;

use App\Entity\FileExecution;
use App\Factory\DatabaseConnectionFactory;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use DateTime;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class ExecuteSQLExportCommand extends Command
{
    public static $defaultName = 'app:export-sql-script';
    private Connection $mainDB;
    private Connection $tmpDB;
    private LoggerInterface $logger;
    private EntityManagerInterface $em;

    public function __construct(
        LoggerInterface           $logger,
        DatabaseConnectionFactory $databaseConnectionFactory,
        EntityManagerInterface    $em,
        private string            $targetDirectory
    )
    {
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
        $this->tmpDB = $databaseConnectionFactory->getSecondConnection();
        $this->logger = $logger;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Export data from temporary database to main database')
            ->setHelp('app:export-sql-script => This command allows you to export data from temporary database to main database')
            ->setAliases(['app:e-s-s']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$this->mainDB instanceof Connection) {
            $io->error('Main database connection is not set !');
            $this->logger->error('Main database connection is not set !');
            return Command::FAILURE;
        }
        if (!$this->tmpDB instanceof Connection) {
            $io->error('Temporary database connection is not set !');
            $this->logger->error('Temporary database connection is not set !');
            return Command::FAILURE;
        }
        try {
            $tablesNames = $this->getTmpAllTableName();
        } catch (Exception $e) {
            $io->error('Error getting table list');;
            $this->logger->error($e->getMessage());
            return Command::FAILURE;
        }

        $now = new DateTime();
        $startTime = microtime(true);
        $fileExecution = (new FileExecution())
            ->setFilename('TMP_DATABASE')
            ->setType(FileExecution::TYPE_EXPORT)
            ->setSize(0)
            ->setSizeDescription(0)
            ->setCreatedAt($now)
            ->setStartAt($startTime)
            ->setIsDeleted(false);
        $this->em->persist($fileExecution);
        // Merging data
        $timestamp = (new DateTime())->getTimestamp();
        foreach ($tablesNames as $tableName) {
            $io->text("Exporting tmp data from <fg=magenta>{$tableName}</> table ...");
            try {
                $this->exportTmpTable($tableName, $timestamp);
            } catch (Exception $e) {
                $io->error('Error exporting data from ' . $tableName . ' table');
                $this->logger->error($e->getMessage());
                $fileExecution->setStatus(FileExecution::STATUS_FAILED);
                $this->em->persist($fileExecution);
                $this->em->flush();
                return Command::FAILURE;
            }
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $fileExecution->setEndAt($endTime)
            ->setExecutionTime($executionTime)
            ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime))
            ->setStatus(FileExecution::STATUS_SUCCESS);
        $this->em->persist($fileExecution);
        $this->em->flush();

        $io->success('Export tmp data executed successfully');
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
        if (!$fileSystem->exists($this->targetDirectory . '/' . $timestamp)) {
            $fileSystem->mkdir($this->targetDirectory . '/' . $timestamp);
        }
        $outputFile = $this->targetDirectory . '/' . $timestamp . '/' . $tableName . '.sql';

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
            $this->logger->info('pg_dump completed successfully', [
                'exit_code' => $process->getExitCode()
            ]);
        } else {
            $this->logger->error('pg_dump failed', [
                'exit_code' => $process->getExitCode(),
            ]);
        }

    }

}