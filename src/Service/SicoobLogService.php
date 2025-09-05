<?php

namespace ThomasSens\SicoobBundle\Service;

use Psr\Log\LoggerInterface;

class SicoobLogService
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function logarPayload(array $dados): void
    {
        $this->logger->info('Sicoob Webhook Pix recebido', ['payload' => $dados]);
    }
}
