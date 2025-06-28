<?php

namespace App\Service;

use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class ErrorLoggerService
{
    public function __construct(
        private LoggerInterface $logger,
        private RequestStack    $requestStack,
        private Security        $security
    )
    {
    }

    public function logError(\Throwable $exception, Level $level = null): void
    {
        $context = [
            'exception' => $exception,
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'code' => $exception->getCode(),
        ];

        // Add request data if available
        $request = $this->requestStack->getCurrentRequest();
        if ($request) {
            $context['request_uri'] = $request->getRequestUri();
            $context['method'] = $request->getMethod();
            $context['ip'] = $request->getClientIp();
            $context['user_agent'] = $request->headers->get('User-Agent', 'Unknown');
        }

        // Add user data if available
        $user = $this->security->getUser();
        if ($user) {
            $context['user_id'] = $user->getUserIdentifier();
        }

        // Add previous exception if exists
        if ($exception->getPrevious()) {
            $context['previous_exception'] = $exception->getPrevious()->getMessage();
        }

        switch ($level) {
            case Level::Error:
                $this->logger->error($exception->getMessage(), $context);
                break;
            case Level::Emergency:
                $this->logger->emergency($exception->getMessage(), $context);
                break;
            case Level::Critical:
                $this->logger->critical($exception->getMessage(), $context);
                break;
            default:
                $this->logger->error($exception->getMessage(), $context);
        }

    }
}