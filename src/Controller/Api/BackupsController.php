<?php

namespace App\Controller\Api;

use App\Entity\FileExecution;
use App\helpers\ByteConverter;
use App\helpers\TimeFormatter;
use App\Service\DataLoader;
use App\Service\ErrorLoggerService;
use App\Service\FileUploader;
use App\Service\SevenZipExtractor;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Monolog\Level;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;


//#[isGranted("ROLE_ADMIN")]
#[Route('/api/backups')]
class BackupsController extends AbstractController
{
    private string $maxFileSizeUpload;
    private string $compressedFileDirectory;
    private string $decompressedFileDirectory;

    public function __construct(
        ParameterBagInterface $parameterBag,
        private ValidatorInterface $validator,
        private ErrorLoggerService $errorLoggerService,
    )
    {
        $this->maxFileSizeUpload = $parameterBag->get('max_file_size_upload');
        $this->compressedFileDirectory = $parameterBag->get('compressed_file_upload_dir');
        $this->decompressedFileDirectory = $parameterBag->get('decompressed_file_upload_dir');
    }

    #[Route('/upload', name: 'api_backups_upload_file', methods: ['POST'])]
    public function uploadBackupData(Request $request, FileUploader $fileUploader, SevenZipExtractor $extractor, DataLoader $dataLoader, EntityManagerInterface $em): JsonResponse
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            return $this->json([
                'error' => 'No file uploaded'
            ], Response::HTTP_BAD_REQUEST);
        }
        $violations = $this->validator->validate($uploadedFile, [
            new Assert\NotNull([
                    'message' => 'Please select a file to upload !'
                ]
            ),
            new Assert\File([
                'maxSize' => $this->maxFileSizeUpload,
                'mimeTypes' => [
                    'application/x-7z-compressed'
                ],
                'mimeTypesMessage' => 'Please upload a valid file !',
            ])
        ]);
        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }
            return $this->json([
                'errors' => $errors
            ], Response::HTTP_BAD_REQUEST);
        }
        // upload the file
        try {
            $fileName = $fileUploader->upload($uploadedFile);
        } catch (Exception $e) {
            $this->errorLoggerService->logError($e, Level::Critical);
            return $this->json([
                'error' => 'Error uploading file !',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        // extract uploaded file
        $uploadedFilePath = $this->compressedFileDirectory . '/' . $fileName;
        try {
            $result = $extractor->extract($uploadedFilePath, $this->decompressedFileDirectory);
        } catch (Exception $e) {
            $this->errorLoggerService->logError($e,Level::Critical);
            return $this->json([
                'error' => 'Error extracting file !'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $decompressedFileName = array_key_first($result['files']);
        $decompressedFilePath = $this->decompressedFileDirectory . '/' . $decompressedFileName;
        // run load data command
        $now = new DateTime();
        $startTime = microtime(true);
        $fileExecution = (new FileExecution())
            ->setFilename($fileName)
            ->setType(FileExecution::TYPE_IMPORT)
            ->setSize(filesize($uploadedFilePath))
            ->setSizeDescription(ByteConverter::formatBytes(filesize($uploadedFilePath) ?? 0))
            ->setCreatedAt($now)
            ->setStartAt($startTime)
            ->setIsDeleted(false);
        $em->persist($fileExecution);
        try {
            $dataLoader->executePsql($decompressedFilePath, DataLoader::TMP_DATABASE_NAME, FileExecution::TYPE_IMPORT);
        } catch (Exception $e) {
            $fileExecution->setStatus(FileExecution::STATUS_FAILED);
            $em->persist($fileExecution);
            $em->flush();
            $this->errorLoggerService->logError($e,Level::Critical);

            return $this->json([
                'error' => 'Error executing load data command !',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $fileExecution->setEndAt($endTime)
            ->setExecutionTime($executionTime)
            ->setExecutionTimeDescription(TimeFormatter::formatShort($executionTime))
            ->setStatus(FileExecution::STATUS_SUCCESS);
        $em->persist($fileExecution);
        $em->flush();

        return $this->json([
            'message' => 'File uploaded successfully'
        ], Response::HTTP_OK);
    }
}