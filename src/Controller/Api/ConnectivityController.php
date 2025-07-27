<?php

namespace App\Controller\Api;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnectivityController extends AbstractController
{
    #[Route('/api/connectivity-test', name: 'connectivity_test', methods: ['GET'])]
    public function testConnectivity(Request $request, LoggerInterface $logger): JsonResponse
    {
        $serverInfo = [
            'status' => 'success',
            'client_ip' => $request->getClientIp(),
            'request_method' => $request->getMethod(),
        ];
        $logger->info('Connectivity test - ' . json_encode($serverInfo));

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}