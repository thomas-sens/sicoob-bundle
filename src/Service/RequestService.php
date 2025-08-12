<?php

namespace ThomasSens\SicoobBundle\Service;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use GuzzleHttp\Client as GClient;

class RequestService {

    private $api_token;
    private $client_id;
    private $client;

    public function __construct(
        private ParameterBagInterface $parameter, 
        private LoggerInterface $logger, 
        private Utils $utils,
    ) {
        $this->api_token = $parameter->get('sicoob.api_token');
        $this->client_id = $parameter->get('sicoob.client_id');
        $this->client = new GClient(['verify' => false]);
    }
    /**
     * Faz uma requisição HTTP e trata a resposta.
     *
     * @param string $method O método HTTP (GET, POST, etc.).
     * @param string $url O URL da requisição.
     * @param array|null $data Dados a serem enviados no corpo da requisição (para métodos POST).
     * @return mixed|null O resultado da deserialização ou null em caso de falha.
     */
    public function makeRequest(string $method, string $url, ?array $data = null, ?string $class = null)
    {
        try {
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$this->api_token,
                    'client_id' => $this->client_id,
                    'x-idempotency-key' => 'UUID'
                ],
                //'cert' => [$this->certificado_pfx, $this->certificado_senha]
            ];

            if ($data !== null) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 200 && $statusCode < 300) {
                if ($class==null) {
                    return $response->getBody()->getContents();
                } else {
                    try {
                        $retorno = json_decode($response->getBody(),true);
                        if (isset($retorno['resultado'])) $retorno = $retorno['resultado'];
                        return $this->utils->convertArrayToCLass($retorno, $class);
                    } catch (Exception $e) {
                        $this->logger->error($e->getMessage());
                        $this->logger->error("Erro ao converter o retorno do endpoint para o objeto $class: " . $response->getBody()->getContents());
                        throw new Exception($e);
                    }
                    
                }
            }

            $this->utils->trataResposta($response, $method);
        } catch (RequestException $e) {
            $this->logger->error("Erro na requisição: " . $e->getMessage());
            if ($e->hasResponse()) {
                $this->utils->trataResposta($e->getResponse(), $method);
            }
            throw new Exception($e);
        }

        return null;
    }

}