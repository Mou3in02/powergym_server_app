<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ConnectivityController extends AbstractController
{
    #[Route('/api/connectivity-test', name: 'connectivity_test', methods: ['GET'])]
    public function testConnectivity(Request $request): JsonResponse
    {
        $serverInfo = [
            'status' => 'success',
            'message' => 'Server is connected and responding',
            'server_time' => date('Y-m-d H:i:s'),
            'client_ip' => $request->getClientIp(),
            'request_method' => $request->getMethod(),
        ];

        return $this->json($serverInfo);
    }
}