<?php

namespace App\Service;

use App\Entity\FileUpload;
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

    public function __construct
    (
        private readonly string                 $targetDirectory,
        private readonly SluggerInterface       $slugger,
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger
    )
    {
        $this->filesystem = new Filesystem();
        if (!$this->filesystem->exists($this->targetDirectory)) {
            $this->filesystem->mkdir($this->targetDirectory);
        }
    }

    public function upload(UploadedFile $file): string
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
            ->setUploadedAt(new DateTime());

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

        return $fileName;
    }

}