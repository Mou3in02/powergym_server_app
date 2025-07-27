<?php

namespace App\Command\dev;

use App\Factory\DatabaseConnectionFactory;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(name: 'app-dev:count-tables-rows')]
class AppCountTablesCommand extends Command
{
    private Connection $mainDB;

    public function __construct(
        DatabaseConnectionFactory $databaseConnectionFactory,
    )
    {
        parent::__construct();
        $this->mainDB = $databaseConnectionFactory->getDefaultConnection();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->mainDB instanceof Connection) {
            $io->error('Main database connection is not set !');
            return Command::FAILURE;
        }
        try {
            $tablesNames = $this->getTmpAllTableName();
        } catch (\Exception $e) {
            $io->error('Error getting table list');;
            return Command::FAILURE;
        }

        foreach ($tablesNames as $tableName) {
            $tableNbRows = $this->TableHasRows($tableName);
            if ($tableNbRows > 0) {
                dump($tableName . ' ' . $tableNbRows);
            }
        }

        return Command::SUCCESS;
    }

    public function getTmpAllTableName(): array
    {
        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_type = 'BASE TABLE' ORDER BY table_name";
        $result = $this->mainDB->executeQuery($sql);

        return $result->fetchFirstColumn();
    }

    public function TableHasRows(string $tableName): int
    {
        // First check if table exists
        $checkTableSql = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'public' AND table_name = ?";
        $tableResult = $this->mainDB->executeQuery($checkTableSql, [$tableName]);

        if ($tableResult->fetchOne() == 0) {
            return false; // Table doesn't exist
        }

        // Check if table has rows
        $countRowsSql = "SELECT COUNT(*) FROM " . $this->mainDB->quoteIdentifier($tableName);
        $rowResult = $this->mainDB->executeQuery($countRowsSql);

        return $rowResult->fetchOne();
    }

}