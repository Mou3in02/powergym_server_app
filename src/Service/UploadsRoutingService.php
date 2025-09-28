<?php

namespace App\Service;

use Monolog\Level;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploadsRoutingService
{
    private array $config;
    private Filesystem $filesystem;

    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
        private readonly ErrorLoggerService    $errorLoggerService,
    )
    {
        $this->filesystem = new Filesystem();
        $isProduction = $this->parameterBag->get('kernel.environment') === 'prod';
        $this->config = $isProduction
            ? $this->parameterBag->get('prod_directories')
            : $this->parameterBag->get('dev_directories');
    }

    public function getUploadsDirectoryPath(): string
    {
        if (!$this->filesystem->exists($this->config['uploads_directory'])) {
            try {
                $this->filesystem->mkdir($this->config['uploads_directory']);
            } catch (\Exception $e) {
                $this->errorLoggerService->logError($e, Level::Critical);
                throw new FileException(sprintf('Directory "%s" was not created.', $this->config['uploads_directory']));
            }
        }
        return $this->config['uploads_directory'];
    }

    public function getCompressedFileUploadDirPath(): string
    {
        if (!$this->filesystem->exists($this->config['compressed_file_upload_dir'])) {
            try {
                $this->filesystem->mkdir($this->config['compressed_file_upload_dir']);
            } catch (\Exception $e) {
                $this->errorLoggerService->logError($e, Level::Critical);
                throw new FileException(sprintf('Directory "%s" was not created.', $this->config['compressed_file_upload_dir']));
            }
        }
        return $this->config['compressed_file_upload_dir'];
    }

    public function getDecompressedFileUploadDirPath(): string
    {
        if (!$this->filesystem->exists($this->config['decompressed_file_upload_dir'])) {
            try {
                $this->filesystem->mkdir($this->config['decompressed_file_upload_dir']);
            } catch (\Exception $e) {
                $this->errorLoggerService->logError($e, Level::Critical);
                throw new FileException(sprintf('Directory "%s" was not created.', $this->config['decompressed_file_upload_dir']));
            }
        }
        return $this->config['decompressed_file_upload_dir'];
    }

    public function getExportedTmpDataDirPath(): string
    {
        if (!$this->filesystem->exists($this->config['exported_tmp_data_dir'])) {
            try {
                $this->filesystem->mkdir($this->config['exported_tmp_data_dir']);
            } catch (\Exception $e) {
                $this->errorLoggerService->logError($e, Level::Critical);
                throw new FileException(sprintf('Directory "%s" was not created.', $this->config['exported_tmp_data_dir']));
            }
        }
        return $this->config['exported_tmp_data_dir'];
    }

}