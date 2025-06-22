<?php

namespace App\Controller\Api;

use App\Service\DataLoader;
use App\Service\FileUploader;
use App\Service\SevenZipExtractor;
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
    private ValidatorInterface $validator;
    private string $maxFileSizeUpload;
    private string $compressedFileDirectory;
    private string $decompressedFileDirectory;

    public function __construct(ParameterBagInterface $parameterBag, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->maxFileSizeUpload = $parameterBag->get('max_file_size_upload');
        $this->compressedFileDirectory = $parameterBag->get('compressed_file_upload_dir');
        $this->decompressedFileDirectory = $parameterBag->get('decompressed_file_upload_dir');
    }

    #[Route('/upload', name: 'api_backups_upload_file', methods: ['POST'])]
    public function uploadBackupData(Request $request, FileUploader $fileUploader, SevenZipExtractor $extractor, DataLoader $dataLoader): JsonResponse
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
        $fileName = $fileUploader->upload($uploadedFile);
        // extract uploaded file
        $uploadedFilePath =  $this->compressedFileDirectory. '/' . $fileName;
        $result = $extractor->extract($uploadedFilePath, $this->decompressedFileDirectory);
        $decompressedFileName = array_key_first($result['files']);
        $decompressedFilePath = $this->decompressedFileDirectory . '/' . $decompressedFileName;
        // run load data command
        try {
            $dataLoader->executePsql($decompressedFilePath);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'message' => 'File uploaded successfully'
        ], Response::HTTP_OK);
    }
}