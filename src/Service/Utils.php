<?php
namespace ThomasSens\SicoobBundle\Service;

use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use ThomasSens\SicoobBundle\Model\Pix\Problema;

class Utils
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Converts the response data to an instance of the specified class.
     *
     * @param StreamInterface $responseData
     * @param string $class The fully qualified class name of the target object.
     * @return object|null An instance of the specified class or null on failure.
     */
    public function convertToClass(StreamInterface $responseData, string $class): ?object
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        // Read the response data as string
        $responseDataString = $responseData->getContents();
        dd(json_decode($responseDataString));
        // Deserialize the JSON to the specified class
        return $serializer->deserialize($responseDataString, $class, 'json');
    }

    public function convertArraYToClass(array $data, string $class): ?object
    {
        try{ 
            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            // Read the response data as string
            $responseDataString = json_encode($data);
            // Deserialize the JSON to the specified class
            return $serializer->deserialize($responseDataString, $class, 'json');
        } catch (Exception $e) {
            $this->logger->error("Erro ao converter resultado em objeto $class: " . $e->getMessage());
            return new Problema(
                type: '',
                title: 'Erro ao converter objeto',
                status: 0,
                detail: $e->getMessage(),
                correlationId: null,
                violacoes: []
            );
        }
    }

    /**
     * Trata a resposta da API e loga informações relevantes.
     *
     * @param ResponseInterface $response A resposta da API.
     * @param string $metodo O nome do método ou operação relacionada à resposta.
     */
    public function trataResposta(ResponseInterface $response, string $metodo): void
    {
        $this->logger->info("Método: $metodo");
        
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        
        // Verifica se o corpo da resposta não está vazio
        if (!empty($body)) {
            $errorData = json_decode($body, true);
            
            // Verifica se a decodificação JSON foi bem-sucedida
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->logger->info("Retornou um status diferente do esperado: $statusCode");
                $this->logger->info("Error Response Body: " . json_encode($errorData, JSON_PRETTY_PRINT));
            } else {
                $this->logger->error("Erro ao decodificar JSON: " . json_last_error_msg());
                $this->logger->info("Resposta não pode ser processada como JSON: " . $body);
            }
        } else {
            $this->logger->info("Resposta vazia recebida com status code: $statusCode");
        }
    }
}