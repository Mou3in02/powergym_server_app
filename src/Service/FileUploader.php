<?php

namespace App\Service;

use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;


class FileUploader
{
    private Filesystem $filesystem;

    public function __construct(private string $targetDirectory, private SluggerInterface $slugger)
    {
        $this->filesystem = new Filesystem();

        // Create an extract directory if it doesn't exist
        if (!$this->filesystem->exists($this->targetDirectory)) {
            $this->filesystem->mkdir($this->targetDirectory);
        }
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . Uuid::v7() . '.' . $file->guessExtension();

        try {
            $file->move($this->targetDirectory, $fileName);
            dump($fileName);
        } catch (FileException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $fileName;
    }

}