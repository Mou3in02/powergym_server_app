<?php

namespace App\Controller\Api;

use App\Service\ErrorLoggerService;
use App\Service\FileUploader;
use Exception;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[isGranted("ROLE_ADMIN")]
#[Route('/api/backups')]
class BackupsController extends AbstractController
{
    private string $maxFileSizeUpload;

    public function __construct(
        ParameterBagInterface            $parameterBag,
        private ValidatorInterface       $validator,
        private ErrorLoggerService       $errorLoggerService,
        private readonly LoggerInterface $logger,
    )
    {
        $this->maxFileSizeUpload = $parameterBag->get('max_file_size_upload');
    }

    #[Route('/upload', name: 'api_backups_upload_file', methods: ['POST'])]
    public function uploadBackupData(Request $request, FileUploader $fileUploader): JsonResponse
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
            $this->logger->info('Backup data successfully uploaded ' . $fileName);
        } catch (Exception $e) {
            $this->errorLoggerService->logError($e, Level::Critical);
            return $this->json([
                'error' => 'Error uploading file !',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'message' => 'File uploaded successfully'
        ], Response::HTTP_OK);
    }
}