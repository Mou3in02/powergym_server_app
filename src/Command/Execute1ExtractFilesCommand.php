<?php

namespace App\Command;

use App\Entity\FileExtract;
use App\Entity\FileUpload;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\ErrorLoggerService;
use App\Service\SevenZipExtractor;
use App\Service\UploadsRoutingService;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Level;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:extract-uploaded-files')]
class Execute1ExtractFilesCommand extends Command
{
    private string $compressedDirectory;
    private string $decompressedDirectory;

    public function __construct(
        private readonly ErrorLoggerService     $logger,
        private readonly EntityManagerInterface $em,
        private readonly SevenZipExtractor      $sevenZipExtractor,
        private readonly UploadsRoutingService  $uploadsRoutingService,
    )
    {
        parent::__construct();
        $this->compressedDirectory = $this->uploadsRoutingService->getCompressedFileUploadDirPath();
        $this->decompressedDirectory = $this->uploadsRoutingService->getDecompressedFileUploadDirPath();
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
        $now = new \DateTime();

        $io->text('---------------------');
        $io->text('[' . $now->format('Y-m-d H:i:s') . ']');
        $io->text('---------------------');

        $uploadedFiles = $this->em->getRepository(FileUpload::class)->findBy([
            'status' => FileUpload::STATUS_PENDING,
            'isDeleted' => false
        ]);

        foreach ($uploadedFiles as $fileUploaded) {
            try {
                $io->text('extracting file - ' . $fileUploaded->getFilename());
                $fileExtract = (new FileExtract())
                    ->setExtractedAt($now)
                    ->setIsDeleted(false);
                // extract uploaded file
                $uploadedFilePath = $this->compressedDirectory . '/' . $fileUploaded->getFileName();
                $result = $this->sevenZipExtractor->extract($uploadedFilePath, $this->decompressedDirectory);
                if (empty($result['files'])) {
                    $errorMessage = 'Failed to extract empty uploaded file: ' . $fileUploaded->getFilename();
                    $io->error($errorMessage);
                    $this->logger->logError(new \Exception($errorMessage), Level::Critical);
                }
                $extractedData = $result['files'][0];
                $fileExtract->setFilename($extractedData['name'])
                    ->setOriginalName($extractedData['name'])
                    ->setSize($extractedData['size'])
                    ->setSizeDescription(ByteConverter::formatBytes($extractedData['size']));
                // If a file extracted without error
                $fileExtract->setStatus(FileExtract::STATUS_PENDING);
                $fileUploaded->setStatus(FileUpload::STATUS_FINISHED);
            } catch (\Exception $e) {
                if (isset($fileExtract)) {
                    $fileExtract->setStatus(FileExtract::STATUS_ERROR);
                }
                $io->error('Error extracting file - ' . $fileUploaded->getFileName());
                $this->logger->logError($e, Level::Critical);
            } finally {
                if (isset($fileExtract)) {
                    $this->em->persist($fileExtract);
                }
            }
            $this->em->persist($fileUploaded);
        }
        $this->em->flush();

        $io->success('Extract files executed successfully');
        $io->text('Number of extracted files processed: ' . count($uploadedFiles));
        $io->text('Execution time: ' . TimeFormatter::formatShort(microtime(true) - $startTime));

        return Command::SUCCESS;
    }
}