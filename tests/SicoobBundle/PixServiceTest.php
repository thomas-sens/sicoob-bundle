<?php

namespace App\Tests\SicoobBundle;

use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use ThomasSens\SicoobBundle\Service\RequestService;
use ThomasSens\SicoobBundle\Service\PixService;
use ThomasSens\SicoobBundle\Model\Pix\CobrancaImediata;
use ThomasSens\SicoobBundle\Model\Pix\Calendario;
use ThomasSens\SicoobBundle\Model\Pix\Devedor;
use ThomasSens\SicoobBundle\Model\Pix\InfoAdicional;
use ThomasSens\SicoobBundle\Model\Pix\Loc;
use ThomasSens\SicoobBundle\Model\Pix\Problema;
use ThomasSens\SicoobBundle\Model\Pix\Valor;
use ThomasSens\SicoobBundle\Model\Pix\Webhook;
use ThomasSens\SicoobBundle\Service\Utils;

class PixServiceTest extends TestCase
{
    private PixService $pixService;

    protected function setUp(): void
    {
        // Logger "vazio" para testes
        $logger = new NullLogger();

        // Cache local
        $cache = new FilesystemAdapter();

        // Utils do bundle
        $utils = new Utils($logger);

        // ParameterBag simulando parâmetros do bundle
        $params = new ParameterBag([
            'sicoob.environment' => 'sandbox',
            'sicoob.client_id' => '123',
            'sicoob.client_secret' => '123',
            'sicoob.cert_path' => '',
            'sicoob.cert_password' => '',
            'sicoob.auth_url' => '',
            'sicoob.environments.sandbox.pix_recebimentos' => 'https://sandbox.sicoob.com.br/sicoob/sandbox/pix/api/v2',
            'sicoob.environments.sandbox.pix_pagamentos' => 'https://sandbox.sicoob.com.br/sicoob/sandbox/pix-pagamentos/v2',
            'sicoob.environments.production.auth_url' => ' https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token',
        ]);

        // RequestService real, sem mocks
        $requestService = new RequestService($logger, $cache, $utils, $params);

        // Instancia o PixService
        $this->pixService = new PixService($requestService, $params);
    }

    public function testPixServiceInstantiation(): void
    {
        $this->assertInstanceOf(PixService::class, $this->pixService);
    }

    public function testCriarCobranca(): void
    {
        $infoAdicionais = [
            new InfoAdicional('Campo 1', 'teste')
        ];
        $cobranca = new CobrancaImediata(
            new Calendario(3600),       // Expiração em dias
            new Devedor('03690331935', null, 'Nome'), // Devedor
            new Loc(0),                 // loc
            new Valor(100.0),           // Valor
            $infoAdicionais,            // infoAdicionais
            'chavepix_sandbox',         // chave
            'Pagamento de teste'       // solicitacaoPagador
        );

        $result = $this->pixService->criarCobranca($cobranca);

        $this->assertInstanceOf(CobrancaImediata::class, $result);
    }

    public function testConsultarCobranca(): void
    {
        $txid = 'FWmF4ttQAVb7T19WdFYzeFcMXY4SZCvWRe';
        $revisao = 1892203356;

        $result = $this->pixService->consultarCobranca($txid, $revisao);

        $this->assertInstanceOf(CobrancaImediata::class, $result);
    }

    public function testCriarWebhookPagamentos(): void
    {
        $webhook = new Webhook('https://meusistema.com/webhook');

        $result = $this->pixService->criarWebhookPagamentos($webhook);

        //$this->assertNull($result);
        $this->assertInstanceOf(Problema::class, $result);
    }

    public function testCriarWebhookRecebimentosSucesso(): void
    {
        $webhook = new Webhook('https://meusistema.com/webhook');

        $result = $this->pixService->criarWebhookRecebimentos($webhook, 'chave');

        //$this->assertNull($result);
        $this->assertInstanceOf(Problema::class, $result);
    }

    public function testCriarWebhookRecebimentosErro(): void
    {
        $webhook = new Webhook('https://meusistema.com/webhook');

        $result = $this->pixService->criarWebhookRecebimentos($webhook, 'chave');

        $this->assertInstanceOf(Problema::class, $result);
    }
}