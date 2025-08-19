<?php
namespace ThomasSens\SicoobBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use ThomasSens\SicoobBundle\Model\Boleto\BoletoConsulta;
use ThomasSens\SicoobBundle\Model\Boleto\BoletoPagamento;
use ThomasSens\SicoobBundle\Model\Boleto\ComprovantePagamento;

class BoletoService {

    private string $apiCobrancaBancaria;

    public function __construct(
        private RequestService $requestService,
        private ParameterBagInterface $params
    ) {
        $env = $this->params->get("sicoob.environment");
        $this->apiCobrancaBancaria = $this->params->get("sicoob.environments.$env.cobranca_bancaria");
    }

    public function consultarBoleto(string $codigoBarras, Int $numeroConta, string $dataPagamento): BoletoConsulta {
        $url = $this->apiCobrancaBancaria . "/boletos/$codigoBarras?numeroConta=$numeroConta&dataPagamento=$dataPagamento";
        return $this->requestService->makeRequestObject('GET', $url, null, BoletoConsulta::class);
    }

    public function pagarBoleto(string $codigoBarras, BoletoPagamento $boletoPagamento): ComprovantePagamento {
        $url = $this->apiCobrancaBancaria . "/boletos/pagamentos/$codigoBarras";
        return $this->requestService->makeRequestObject('POST', $url, $boletoPagamento->toArray() , ComprovantePagamento::class);
    }

    public function criarBoleto() {
        return null;
    }

}