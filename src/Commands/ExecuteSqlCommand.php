<?php

namespace App\Commands;

use App\Service\DataLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

class ExecuteSqlCommand extends Command
{
    public static $defaultName = 'app:import-sql-script';

    public function __construct(private Filesystem $filesystem, private DataLoader $dataLoader, private string $targetDirectory)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import SQL file to database')
            ->setHelp('app:import-sql-script => This command allows you to import SQL file to database')
            ->setAliases(['app:i-s'])
            ->addArgument('filename', InputArgument::REQUIRED, 'The filename of the SQL file to import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('filename');
        $filePath = $this->targetDirectory . '/' . $filename;
        // check a file to execute
        if (!$this->filesystem->exists($filePath)) {
            $output->error("File does not exist: {$filename} in directory {$this->targetDirectory}");
            return Command::FAILURE;
        }
        if (!is_readable($filePath)) {
            $io->error(sprintf('File "%s" is not readable.', $filePath));
            return Command::FAILURE;
        }
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        if($fileExtension !== 'psql') {
            $output->error('File extension must be .psql');
            return Command::FAILURE;
        }
        // Get database connection parameters from Doctrine
        $io->text("Executing SQL file: {$filename} ...");;
        try {
            $result = $this->dataLoader->executePsql($filename);
        }catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
        $io->success('SQL file executed successfully ');

        return Command::SUCCESS;
    }


}