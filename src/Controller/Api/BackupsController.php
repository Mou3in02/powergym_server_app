<?php

namespace App\Controller\Api;

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
    private ValidatorInterface $validator;

    public function __construct(ParameterBagInterface $parameterBag, ValidatorInterface $validator)
    {
        $this->maxFileSizeUpload = $parameterBag->get('max_file_size_upload');
        $this->validator = $validator;
    }

    #[Route('/upload', name: 'api_backups_upload_file', methods: ['POST'])]
    public function uploadBackupData(Request $request): JsonResponse
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
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        dump($originalFilename);
        die;
        return $this->json('OK');
    }
}