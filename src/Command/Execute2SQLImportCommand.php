<?php

namespace App\Command;

use App\Entity\FileExecution;
use App\Entity\FileExtract;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use App\Service\ErrorLoggerService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Monolog\Level;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(name: 'app:import-sql-script')]
class Execute2SQLImportCommand extends Command
{
    public function __construct(
        private readonly ErrorLoggerService     $logger,
        private readonly Filesystem             $filesystem,
        private readonly DataLoader             $dataLoader,
        private readonly EntityManagerInterface $em,
        private readonly string                 $decompressedDirectory
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import SQL file to tmp database')
            ->setHelp('app:import-sql-script => This command allows you to import SQL file to tmp database')
            ->setAliases(['app:i-s-s']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $startTime = microtime(true);

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
                $result = $this->dataLoader->executePsql($filePath, DataLoader::TMP_DATABASE_NAME, FileExecution::TYPE_IMPORT);
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
                $this->logger->logError($e, Level::Critical);
            }
        }

        $this->em->flush();
        $io->text('Number of SQL executed files processed: ' . count($extractedFiles));
        $io->success('SQL file executed successfully');
        $io->info('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }

}