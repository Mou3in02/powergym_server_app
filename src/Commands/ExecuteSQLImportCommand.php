<?php

namespace App\Commands;

use App\Entity\FileExecution;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

class ExecuteSQLImportCommand extends Command
{
    public static $defaultName = 'app:import-sql-script';

    public function __construct(
        private readonly Filesystem             $filesystem,
        private readonly DataLoader             $dataLoader,
        private readonly EntityManagerInterface $em,
        private readonly string                 $targetDirectory
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import SQL file to tmp database')
            ->setHelp('app:import-sql-script => This command allows you to import SQL file to tmp database')
            ->setAliases(['app:i-s-s'])
            ->addArgument('filename', InputArgument::REQUIRED, 'The filename of the SQL file to import');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('filename');
        $filePath = $this->targetDirectory . '/' . $filename;
        // check a file to execute
        if (!$this->filesystem->exists($filePath)) {
            $io->error("File does not exist: {$filename} in directory {$this->targetDirectory}");
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
        $startTime = microtime(true);
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
            $result = $this->dataLoader->executePsql($filePath, DataLoader::TMP_DATABASE_NAME, FileExecution::TYPE_IMPORT);
        } catch (Exception $e) {
            $fileExecution->setStatus(FileExecution::STATUS_FAILED);
                $this->em->persist($fileExecution);
                $this->em->flush();
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $fileExecution->setEndAt($endTime)
            ->setExecutionTime($executionTime)
            ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime))
            ->setStatus(FileExecution::STATUS_SUCCESS);
        $this->em->persist($fileExecution);
        $this->em->flush();

        $io->success('SQL file executed successfully ');
        return Command::SUCCESS;
    }

}