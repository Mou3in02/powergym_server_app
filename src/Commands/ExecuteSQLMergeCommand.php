<?php

namespace App\Commands;

use App\Service\DataLoader;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ExecuteSQLMergeCommand extends Command
{
    public static $defaultName = 'app:merge-sql-script';

    public function __construct(
        private readonly DataLoader $dataLoader,
        private readonly LoggerInterface $logger,
        private readonly Filesystem $filesystem,
        private readonly string $targetDirectory
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Merge tmp data from exported_tmp_data directory to main database')
            ->setHelp('app:merge-sql-script => This command allows you to merge data from temporary directory to main database')
            ->setAliases(['app:m-s-s'])
            ->addArgument('timestamp', InputArgument::REQUIRED, 'Timestamp (directory) of the exported tmp SQL file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $timestamp = $input->getArgument('timestamp');
        // check exported directories
        if (!$this->filesystem->exists($this->targetDirectory . '/' . $timestamp)) {
            $io->error("Exported tmp data directory does not exist: {$timestamp}");
            $this->logger->error("Exported tmp data directory does not exist: {$timestamp}");
            return Command::FAILURE;
        }
        $files = $this->getAllExportedFiles($this->targetDirectory . '/' . $timestamp);
        foreach ($files as $file) {
            $io->text("Executing SQL file: <fg=magenta>{$file['filename']}</> ...");
            // Get database connection parameters from Doctrine
            try {
                $result = $this->dataLoader->executePsql($file['path'], DataLoader::DATABASE_NAME);
            } catch (Exception $e) {
                $io->error('Error executing SQL file: ' . $file['filename']);
                $this->logger->error($e->getMessage());
                return Command::FAILURE;
            }
        }

        $io->success('Merge tmp data executed successfully');
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

}