<?php

namespace App\Commands;

use App\Entity\FileExtract;
use App\Entity\FileUpload;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\ErrorLoggerService;
use App\Service\SevenZipExtractor;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Level;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:extract-uploaded-files')]
class ExtractFilesCommand extends Command
{
    public function __construct(
        ErrorLoggerService     $logger,
        EntityManagerInterface $em,
        SevenZipExtractor      $sevenZipExtractor,
        private string         $compressedDirectory,
        private string         $decompressedDirectory,
    )
    {
        parent::__construct();
        $this->logger = $logger;
        $this->em = $em;
        $this->sevenZipExtractor = $sevenZipExtractor;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Extract uploaded files data')
            ->setHelp('app:extract-uploaded-files => This command allows you to extract files.')
            ->setAliases(['app:e-u-f']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $startTime = microtime(true);

        $filesToExtract = $this->em->getRepository(FileUpload::class)->findBy([
            'status' => FileExtract::STATUS_PENDING,
            'isDeleted' => false
        ]);
        $io->info('Starting extracting uploaded files ...');
        foreach ($filesToExtract as $fileImport) {
            try {
                $io->text('extracting file - ' . $fileImport->getFilename());
                $fileExtract = (new FileExtract())
                    ->setFilename($fileImport->getFilename())
                    ->setOriginalName($fileImport->getOriginalName())
                    ->setExtractedAt(new \DateTime())
                    ->setStatus(FileExtract::STATUS_PENDING)
                    ->setSize($fileImport->getSize())
                    ->setSizeDescription(ByteConverter::formatBytes($fileImport->getSize()))
                    ->setIsDeleted(false);
                // extract uploaded file
                $uploadedFilePath = $this->compressedDirectory . '/' . $fileImport->getFileName();
                $result = $this->sevenZipExtractor->extract($uploadedFilePath, $this->decompressedDirectory);
                $fileExtract->setStatus(FileExtract::STAUS_EXECUTED);
            } catch (\Exception $exception) {
                if (isset($fileExtract)) {
                    $fileExtract->setStatus(FileExtract::STATUS_ERROR);
                }
                $io->error('Error extracting file - ' . $fileImport->getFileName());
                $this->logger->logError($exception, Level::Critical);
            } finally {
                $fileImport->setStatus(FileUpload::STAUS_EXTRACTED);
            }
            $this->em->persist($fileImport);
            if (isset($fileExtract)) {
                $this->em->persist($fileExtract);
            }
        }

        $this->em->flush();
        $io->success('Extract files executed successfully');
        $io->info('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }
}