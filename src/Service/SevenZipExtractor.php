<?php

namespace App\Service;

use Archive7z\Archive7z;
use Symfony\Component\Filesystem\Filesystem;

class SevenZipExtractor
{
    private Filesystem $filesystem;
    private string $targetDirectory;

    public function __construct(private readonly UploadsRoutingService  $uploadsRoutingService)
    {
        $this->filesystem = new Filesystem();
        $this->targetDirectory = $this->uploadsRoutingService->getDecompressedFileUploadDirPath();
    }

    /**
     * Extract a 7z file
     */
    public function extract(string $archiveFilePath, ?string $destinationPath = null): array
    {
        if (!$this->filesystem->exists($archiveFilePath)) {
            throw new \InvalidArgumentException("Archive file does not exist: {$archiveFilePath}");
        }

        $destination = $destinationPath ?: $this->targetDirectory;
        if (!$this->filesystem->exists($destination)) {
            $this->filesystem->mkdir($destination);
        }

        $data = [];
        try {
            $archive = new Archive7z($archiveFilePath);
            // Get a list of files in the archive
            $entries = $archive->getEntries();
            $extractedFiles = [];
            // Extract all files
            foreach ($entries as $entry) {
                if (!$entry->isDirectory()) {
                    $outputPath = $destination . '/' . $entry->getPath();
                    // Create a directory structure if needed
                    $dir = dirname($outputPath);
                    if (!$this->filesystem->exists($dir)) {
                        $this->filesystem->mkdir($dir);
                    }
                    // Extract the file
                    $entry->extractTo($destination);
                    $extractedFiles[] = [
                        'path' => $outputPath,
                        'name' => $entry->getPath(),
                        'size' => $entry->getSize(),
                    ];
                }
            }

            return [
                'destination' => $destination,
                'files' => $extractedFiles,
                'count' => count($extractedFiles),
            ];

        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to extract archive: " . $e->getMessage());
        }
    }

}