<?php

namespace App\Service;

use App\Entity\FileUpload;
use App\helpers\ByteConverter;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;


class FileUploader
{
    private string $targetDirectory;

    public function __construct
    (
        private readonly SluggerInterface       $slugger,
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface        $logger,
        private readonly UploadsRoutingService  $uploadsRoutingService
    )
    {
        $this->targetDirectory = $this->uploadsRoutingService->getCompressedFileUploadDirPath();
    }

    public function upload(UploadedFile $file, bool $isService = false): FileUpload
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . Uuid::v7() . '.' . $file->guessExtension();
        $fileUpload = (new FileUpload())
            ->setFilename($fileName)
            ->setOriginalName($originalFilename)
            ->setSize($file->getSize() ?? null)
            ->setSizeDescription(ByteConverter::formatBytes($file->getSize() ?? 0))
            ->setIsDeleted(false)
            ->setUploadedAt(new DateTime())
            ->setIsByService($isService);

        try {
            $file->move($this->targetDirectory, $fileName);
            $fileUpload->setStatus(FileUpload::STATUS_PENDING);
            $this->em->persist($fileUpload);
            $this->em->flush();
        } catch (FileException $e) {
            $fileUpload->setStatus(FileUpload::STATUS_ERROR);
            $this->em->persist($fileUpload);
            $this->em->flush();
            $this->logger->error($e->getMessage());
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $fileUpload;
    }

}