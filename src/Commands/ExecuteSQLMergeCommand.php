<?php

namespace App\Commands;

use App\Factory\DatabaseConnectionFactory;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExecuteSQLMergeCommand extends Command
{
    public static $defaultName = 'app:merge-sql-script';
    private LoggerInterface $logger;
    private Connection $mainDB;

    public function __construct(LoggerInterface $logger, DatabaseConnectionFactory $databaseConnectionFactory, private string $targetDirectory)
    {
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
        $this->logger = $logger;
        parent::__construct();
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
        if (!$this->mainDB instanceof Connection) {
            $io->error('Main database connection is not set !');
            $this->logger->error('Main database connection is not set !');
            return Command::FAILURE;
        }


        $io->success('Merge tmp data executed successfully');
        return Command::SUCCESS;
    }

}