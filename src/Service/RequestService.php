<?php

namespace ThomasSens\SicoobBundle\Service;

use Exception;
use GuzzleHttp\Client as GClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use ThomasSens\SicoobBundle\Model\Pix\CobrancaImediata;
use ThomasSens\SicoobBundle\Model\Pix\Problema;

class RequestService
{
    private GClient $client;
    private string $clientId;
    private string $authUrl;      // endpoint de autenticação do Sicoob
    private string $certPath;     // cert.pem
    private string $certKey;      // key.pem
    private string $certPassword; // senha do certificado
    private string $environment;  // <- sandbox ou production

    public function __construct(
        private LoggerInterface $logger,
        private CacheInterface $cache,
        private Utils $utils,
        private ParameterBagInterface $params
    ) {
        $this->environment = $this->params->get("sicoob.environment");
        $this->clientId = $this->params->get("sicoob.client_id");
        $this->certPath = $this->params->get("sicoob.cert_path");
        $this->certPassword = $this->params->get("sicoob.cert_password");
        $this->certKey = $this->params->get("sicoob.cert_key");
        $this->authUrl =$this->params->get("sicoob.environments.production.auth_url");
        $this->client = new GClient(['verify' => false]);
    }

    /**
     * Obtém e guarda o token de acesso no cache
     */
    private function getApiToken(): string
    {
        // Se for sandbox, retorna token fixo
        if ($this->environment === 'sandbox') {
            return 'TOKEN_SANDBOX_FIXO';
        }

        return $this->cache->get('sicoob.api_token', function (ItemInterface $item) {
            // cache por 4 minutos (token dura ~5min)
            $item->expiresAfter(240);

            $response = $this->client->post($this->authUrl, [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'scope' => 'cob.read cob.write cobv.write cobv.read lotecobv.write lotecobv.read pix.write pix.read webhook.read webhook.write payloadlocation.write payloadlocation.read',
                ],
                'cert'    => $this->certPath,
                'ssl_key' => [$this->certKey, $this->certPassword],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['access_token'])) {
                throw new Exception("Erro ao obter access_token do Sicoob");
            }

            return $data['access_token'];
        });
    }

    /**
     * Faz uma requisição HTTP para a API Sicoob
     */
    public function makeRequest(string $method, string $url, ?array $data = null): array
    {
        try {
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->getApiToken(),
                    'client_id' => $this->clientId,
                    'x-idempotency-key' => 'UUID'
                ],
            ];

            // só adiciona certificado se não for sandbox
            if ($this->environment !== 'sandbox') {
                $options['cert'] = $this->certPath;
                $options['ssl_key'] = [$this->certKey, $this->certPassword];
            }

            if ($data !== null) {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $url, $options);

            $statusCode = $response->getStatusCode();
            $body = (string) $response->getBody(); // cast direto, evita problemas com getContents() esvaziado

            $decoded = json_decode($body, true);

            return is_array($decoded) ? $decoded : ['body' => $body, 'status' => $statusCode];

        } catch (RequestException $e) {
            $body = null;

            if ($e->hasResponse()) {
                $body = (string) $e->getResponse()->getBody(); // lê todo o conteúdo
                $decoded = json_decode($body, true);

                $this->logger->error('Erro na requisição Sicoob', [
                    'status' => $e->getResponse()->getStatusCode(),
                    'body' => $decoded ?? $body, // se JSON válido, loga como array
                    'url' => $url,
                    'method' => $method,
                    'request_data' => $data,
                ]);
            } else {
                $this->logger->error('Erro na requisição Sicoob sem resposta', [
                    'exception' => $e->getMessage(),
                    'url' => $url,
                    'method' => $method,
                    'request_data' => $data,
                ]);
            }

            throw $e;
        }
    }


    /**
     * Faz a requisição e converte o resultado em um objeto da classe informada
     *
     * @param string $method   Método HTTP (GET, POST, etc.)
     * @param string $url      URL da API
     * @param array|null $data Dados a enviar no corpo da requisição
     * @param string $class    Classe de destino para conversão
     * @return object|null     Instância da classe informada ou null
     * @throws Exception
     */
    public function makeRequestObject(string $method, string $url, ?array $data, ?string $class, bool $asArray = false): array|object|null
    {
        $result = $this->makeRequest($method, $url, $data);
        if ($class === null) {
            return $result;
        }

        // Se o status indicar erro (4xx ou 5xx), retorna Problema
        if (isset($result['status']) && ($result['status'] >= 400 && $result['status'] < 600)) {
            return Problema::fromArray($result);
        }

        return $this->tratarParticularidadesClasse($result, $class, $asArray);

    }
       
    private function tratarParticularidadesClasse(array $result, string $class, bool $asArray): array|object|null {
        if ($asArray && $class === CobrancaImediata::class && isset($result['cobs'])) {
            return array_map(
                fn(array $item) => $this->utils->convertArrayToClass($item, $class),
                $result['cobs']
            );
        } elseif (isset($result['resultado'])) {
            return $this->utils->convertArrayToClass($result['resultado'], $class);
        } elseif (isset($result['body'])) {
            return new Problema(
                type: '',
                title: 'Erro de requisição',
                status: $result['status'],
                detail: $result['body'],
                correlationId: null,
                violacoes: []
            );
        } else {
            return $this->utils->convertArrayToClass($result, $class);
        }
    }
}
