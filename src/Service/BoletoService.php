<?php
namespace ThomasSens\SicoobBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use ThomasSens\SicoobBundle\Model\Boleto\BoletoConsulta;
use ThomasSens\SicoobBundle\Model\Boleto\BoletoPagamento;
use ThomasSens\SicoobBundle\Model\Boleto\ComprovantePagamento;

class BoletoService {

    private $api_url;

    public function __construct(
        private RequestService $requestService,
        private ParameterBagInterface $parameter
    ) {
        $this->api_url = $parameter->get('sicoob.api_url');
    }

    public function consultarBoleto(string $codigoBarras, Int $numeroConta, string $dataPagamento): BoletoConsulta {
        $url = $this->api_url . "/cobranca-bancaria-pagamentos/v3/boletos/$codigoBarras?numeroConta=$numeroConta&dataPagamento=$dataPagamento";
        return $this->requestService->makeRequest('GET', $url, null, BoletoConsulta::class);
    }

    public function pagarBoleto(string $codigoBarras, BoletoPagamento $boletoPagamento): ComprovantePagamento {
        $url = $this->api_url . "/cobranca-bancaria-pagamentos/v3/boletos/pagamentos/$codigoBarras";
        return $this->requestService->makeRequest('POST', $url, $boletoPagamento->toArray() , ComprovantePagamento::class);
    }

    public function criarBoleto() {
        return null;
    }

}