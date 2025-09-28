<?php

namespace App\Command\dev;

use App\Factory\DatabaseConnectionFactory;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use App\Service\ErrorLoggerService;
use Doctrine\DBAL\Connection;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:create-database-schema',
    description: 'Creates the database schema from PostgreSQL dump using psql command',
)]
class CreateDatabaseSchemaCommand extends Command
{
    private Connection $mainDB;

    public function __construct(
        private readonly ErrorLoggerService $errorLogger,
        private readonly LoggerInterface    $logger,
        private readonly Connection         $connection,
        DatabaseConnectionFactory           $databaseConnectionFactory,
        private string                      $filePath,
    )
    {
        parent::__construct();
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $startTime = microtime(true);

        if (!$this->mainDB instanceof Connection) {
            $errorMsq = 'Main database connection is not set !';
            $io->error($errorMsq);
            $this->errorLogger->logError(new \Exception($errorMsq));
            return Command::FAILURE;
        }

        $fileSystem = new Filesystem();
        if (!$this->filePath) {
            $io->error("File is missing: {$this->filePath}");
            $this->errorLogger->logError(new \Exception("File is missing: {$this->filePath}"));
            return Command::FAILURE;
        }
        if (!$fileSystem->exists($this->filePath)) {
            $io->error("File does not exist: {$this->filePath}");
            $this->errorLogger->logError(new \Exception("File does not exist: {$this->filePath}"));
            return Command::FAILURE;
        }

        try {
            $params = $this->connection->getParams();
            $host = $params['host'] ?? 'localhost';
            $port = $params['port'] ?? 5432;
            $user = $params['user'];
            $password = $params['password'];
            $commandScript = [
                'psql',
                '-h', $host,
                '-p', (string)$port,
                '-U', $user,
                '-d', 'db_test', // DataLoader::MAIN_DATABASE_NAME,
                '-f', $this->filePath
            ];

            $io->text('Executing SQL file database schema command ...');
            $process = new Process($commandScript);
            $process->setTimeout(600);
            $env = $process->getEnv();
            $env['PGPASSWORD'] = $password;
            $process->setEnv($env);

            $this->logger->info('Executing psql', [
                'file' => $this->filePath,
                'database' => 'db_test', // DataLoader::MAIN_DATABASE_NAME,
                'host' => $host,
                'port' => $port,
                'user' => $user
            ]);

            $process->run();
            $errorOutput = $process->getErrorOutput();

            if ($process->isSuccessful()) {
                $this->logger->info('psql completed successfully', [
                    'file' => $this->filePath,
                    'exit_code' => $process->getExitCode()
                ]);
            } else {
                $this->errorLogger->logError(new \Exception($errorOutput), Level::Critical);
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $io->error('Exception occurred: ' . $e->getMessage());
            $this->errorLogger->logError($e, Level::Critical);
            return Command::FAILURE;
        }

        $io->success('Database schema created successfully');
        $io->info('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }

}
