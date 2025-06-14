<?php

namespace App\Service;

use Doctrine\DBAL\Connection;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class DataLoader
{

    private $connection;
    private $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function executePsql(string $filePath): array
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
        $dbname = $params['dbname'] ?? '';
        $user = $params['user'] ?? '';
        $password = $params['password'] ?? '';
        $command = [
            'psql',
            '-h', $host,
            '-p', (string)$port,
            '-U', $user,
            '-d', $dbname,
            '-f', $filePath
        ];

        $process = new Process($command, null, null, null, null);
        $process->setTimeout(null);
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

        $process->mustRun();
        $output = $process->getOutput();
        $errorOutput = $process->getErrorOutput();

        $this->logger->info('psql completed successfully', [
            'file' => $filePath,
            'exit_code' => $process->getExitCode()
        ]);

        return [
            'success' => true,
            'method' => 'psql',
            'output' => $output,
            'error_output' => $errorOutput,
            'exit_code' => $process->getExitCode()
        ];
    }
}