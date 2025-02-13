<?php

namespace ThomasSens\SicoobBundle\Service;

use GuzzleHttp\Client as GClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use ThomasSens\SicoobBundle\Model\BoletoConsulta;
use ThomasSens\SicoobBundle\Model\BoletoPagamento;
use ThomasSens\SicoobBundle\Model\ComprovantePagamento;
use ThomasSens\SicoobBundle\Service\Utils;

class SicoobClient
{
    private $api_url;
    private $api_token;
    private $client_id;
    private $logger;
    private $client;
    private $utils;

    public function __construct(ParameterBagInterface $parameter, LoggerInterface $logger, Utils $utils)
    {
        $this->logger = $logger;
        $this->utils = $utils;
        $this->api_url = $parameter->get('sicoob.api_url');
        $this->api_token = $parameter->get('sicoob.api_token');
        $this->client_id = $parameter->get('sicoob.client_id');
        $this->client = new GClient(['verify' => false]);
    }

    public function consultarBoleto(string $codigoBarras, Int $numeroConta, String $dataPagamento): BoletoConsulta {

        $url = $this->api_url . "/cobranca-bancaria-pagamentos/v3/boletos/$codigoBarras?numeroConta=$numeroConta&dataPagamento=$dataPagamento";
        return $this->makeRequest('GET', $url, null, BoletoConsulta::class);
    }

    public function pagarBoleto(string $codigoBarras, BoletoPagamento $boletoPagamento) {

        $url = $this->api_url . "/cobranca-bancaria-pagamentos/v3/boletos/pagamentos/$codigoBarras";
        return $this->makeRequest('POST', $url, $boletoPagamento->toArray() , ComprovantePagamento::class);
    }

    /**
     * Faz uma requisição HTTP e trata a resposta.
     *
     * @param string $method O método HTTP (GET, POST, etc.).
     * @param string $url O URL da requisição.
     * @param array|null $data Dados a serem enviados no corpo da requisição (para métodos POST).
     * @return mixed|null O resultado da deserialização ou null em caso de falha.
     */
    private function makeRequest(string $method, string $url, array $data = null, ?string $class)
    {
        try {
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->api_token,
                    'client_id' => $this->client_id,
                    'x-idempotency-key' => 'UUID'

                ]
            ];

            if ($data !== null) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                if ($class==null) {
                    return $response->getBody()->getContents();
                } else {
                    return $this->utils->convertArrayToCLass(json_decode($response->getBody(),true)['resultado'], $class);
                }
            }

            $this->utils->trataResposta($response, $method);
        } catch (RequestException $e) {
            $this->logger->error("Erro na requisição: " . $e->getMessage());
            if ($e->hasResponse()) {
                $this->utils->trataResposta($e->getResponse(), $method);
            }
        }

        return null;
    }

}