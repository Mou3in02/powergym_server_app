<?php

namespace App\Service;

use Archive7z\Archive7z;
use Symfony\Component\Filesystem\Filesystem;

class SevenZipExtractor
{
    private Filesystem $filesystem;

    public function __construct(private string $targetDirectory)
    {
        $this->filesystem = new Filesystem();

        // Create an extract directory if it doesn't exist
        if (!$this->filesystem->exists($this->targetDirectory)) {
            $this->filesystem->mkdir($this->targetDirectory);
        }
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
                    $extractedFiles[] = $outputPath;
                }
            }

            return [
                'success' => true,
                'destination' => $destination,
                'files' => $extractedFiles,
                'count' => count($extractedFiles)
            ];

        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to extract archive: " . $e->getMessage());
        }
    }

    /**
     * List contents of 7z file without extracting
     */
    public function listContents(string $archivePath): array
    {
        if (!$this->filesystem->exists($archivePath)) {
            throw new \InvalidArgumentException("Archive file does not exist: {$archivePath}");
        }

        try {
            $archive = new Archive7z($archivePath);
            $entries = $archive->getEntries();
            $contents = [];

            foreach ($entries as $entry) {
                $contents[] = [
                    'path' => $entry->getPath(),
                    'size' => $entry->getSize(),
                    'packed_size' => $entry->getPackedSize(),
                    'is_directory' => $entry->isDirectory(),
                    'modified' => $entry->getModified()
                ];
            }

            return $contents;
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to read archive: " . $e->getMessage());
        }
    }
}