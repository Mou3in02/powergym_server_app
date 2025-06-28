<?php

namespace App\Service;

use App\Entity\FileImport;
use App\helpers\ByteConverter;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;


class FileUploader
{
    private Filesystem $filesystem;

    public function __construct(private string $targetDirectory, private SluggerInterface $slugger, private EntityManagerInterface $em, private LoggerInterface $logger)
    {
        $this->filesystem = new Filesystem();
        if (!$this->filesystem->exists($this->targetDirectory)) {
            $this->filesystem->mkdir($this->targetDirectory);
        }
    }

    public function upload(UploadedFile $file): string
    {
        $fileImport = new FileImport();
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . Uuid::v7() . '.' . $file->guessExtension();
        $fileImport->setFilename($fileName)
            ->setOriginalName($originalFilename)
            ->setSize($file->getSize() ?? null)
            ->setSizeDescription(ByteConverter::formatBytes($file->getSize() ?? 0))
            ->setIsDeleted(false)
            ->setImportedAt(new DateTime());

        try {
            $file->move($this->targetDirectory, $fileName);
            $fileImport->setStatus(FileImport::STATUS_IMPORTED);
            $this->em->persist($fileImport);
            $this->em->flush();
        } catch (FileException $e) {
            $fileImport->setStatus(FileImport::STATUS_ERROR);
            $this->em->persist($fileImport);
            $this->em->flush();
            $this->logger->error($e->getMessage());
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $fileName;
    }

}