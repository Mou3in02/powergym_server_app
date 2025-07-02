<?php

namespace App\Service;

use Doctrine\DBAL\Connection;
use InvalidArgumentException;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class DataLoader
{
    const DATABASE_NAME = 'power_gym_database';
    const TMP_DATABASE_NAME = 'power_gym_database_tmp';

    public function __construct(
        private Connection         $connection,
        private LoggerInterface    $logger,
        private ErrorLoggerService $errorLoggerService,
    )
    {
    }

    public function executePsql(string $filePath, string $dbname, string $fileExecType): array
    {
        if (!file_exists($filePath)) {
            throw new InvalidArgumentException("File does not exist: {$filePath}");
        }
        if (!is_readable($filePath)) {
            throw new InvalidArgumentException("File is not readable: {$filePath}");
        }
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
            '-d', $dbname,
            '-f', $filePath
        ];

        $process = new Process($commandScript);
        $process->setTimeout(600);
        $env = $process->getEnv();
        $env['PGPASSWORD'] = $password;
        $process->setEnv($env);

        $this->logger->info('Executing psql', [
            'file' => $filePath,
            'database' => $dbname,
            'host' => $host,
            'port' => $port,
            'user' => $user
        ]);

        $process->run();
        $output = $process->getOutput();
        $errorOutput = $process->getErrorOutput();

        if ($process->isSuccessful()) {
            $this->logger->info('psql completed successfully', [
                'file' => $filePath,
                'exit_code' => $process->getExitCode()
            ]);
        } else {
            $this->errorLoggerService->logError(new \Exception($errorOutput), Level::Critical);
        }

        return [
            'success' => true,
            'method' => 'psql',
            'output' => $output,
            'error_output' => $errorOutput,
            'exit_code' => $process->getExitCode()
        ];
    }
}