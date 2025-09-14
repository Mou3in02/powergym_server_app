<?php

namespace App\Controller;

use App\Repository\FileUploadRepository;
use App\Service\ErrorLoggerService;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/upload', name: 'index_backups_upload_file', methods: ['GET'])]
    public function index(FileUploadRepository $fileUploadRepository): Response
    {
        $uploadedFiles = $fileUploadRepository->findBy(['isDeleted' => false], ['uploadedAt' => 'DESC']);

        return $this->render('backups/index.html.twig', [
            'uploadedFiles' => $uploadedFiles,
        ]);
    }

    #[Route('/upload', name: 'backups_upload_file', methods: ['POST'])]
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
                    'application/x-7z-compressed',
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

    #[Route('/upload/delete', name: 'delete_backups_upload_file', methods: ['DELETE'])]
    public function deleteUploadedFile(Request $request, FileUploadRepository $fileUploadRepository, EntityManagerInterface $em): JsonResponse
    {
        $fileId = $request->query->get('fileId');
        if (empty($fileId)){
            return $this->json([
                'message' => 'Bad request !',
            ], Response::HTTP_BAD_REQUEST);
        }
        if(!$this->isGranted('ROLE_SUPER_ADMIN')){
            return $this->json([
                'message' => 'You are not allowed to delete this file !',
            ], Response::HTTP_FORBIDDEN);
        }
        $uploadedFile = $fileUploadRepository->find($fileId);
        if(!$uploadedFile){
            return $this->json([
                'message' => 'File not found !',
            ], Response::HTTP_NOT_FOUND);
        }
        $uploadedFile->setIsDeleted(true);
        $em->persist($uploadedFile);
        $em->flush();

        return $this->json([
            'message' => 'File deleted successfully !',
        ], Response::HTTP_OK);
    }
}