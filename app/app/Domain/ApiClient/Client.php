<?php 

namespace App\Domain\ApiClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;

use App\Domain\ApiClient\Exceptions\HttpBadRequestException;
use App\Domain\ApiClient\Exceptions\HttpInternalServerErrorException;
use App\Domain\ApiClient\Exceptions\HttpNotFoundException;
use App\Domain\ApiClient\Exceptions\HttpStatusCode;
use App\Domain\ApiClient\Exceptions\HttpUnauthorizedException;

class Client 
{
    private ClientConfig $config;

    private ?GuzzleClient $client = null;

    public function __construct(ClientConfig $config)
    {
        $this->setConfig($config);
    }

    public function getConfig(): ClientConfig
    {
        return $this->config;
    }

    public function setConfig(ClientConfig $config): self
    {
        $this->config = $config;
        return $this;
    }

    private function getClient(): GuzzleClient
    {
        if (is_null($this->client)) {
            $this->client = new GuzzleClient(
                $this->config->toArray()
            );
        }

        return $this->client;
    }

    public function get(string $uri, ?array $queryParams = null, array $options = [])
    {
        $options = $this->buildQueryAndBodyOptions($queryParams) + $options;

        return $this->request('GET', $uri, $options);
    }

    public function post(string $uri, ?array $queryParams = null, ?array $bodyJson = null, ?array $bodyFormParams = null, array $options = [])
    {
        $options = $this->buildQueryAndBodyOptions($queryParams, $bodyJson, $bodyFormParams) + $options;

        return $this->request('POST', $uri, $options);
    }

    public function put(string $uri, ?array $queryParams = null, ?array $bodyJson = null, array $options = [])
    {
        $options = $this->buildQueryAndBodyOptions($queryParams, $bodyJson) + $options;

        return $this->request('PUT', $uri, $options);
    }

    public function delete(string $uri, ?array $queryParams = null, array $options = [])
    {
        $options = $this->buildQueryAndBodyOptions($queryParams) + $options;

        return $this->request('DELETE', $uri, $options);
    }

    private function buildQueryAndBodyOptions(
        ?array $queryParams = null,
        ?array $bodyJson = null,
        ?array $bodyFormParams = null
    ): array {
        $options = [];

        if (!is_null($queryParams)) {
            $options[RequestOptions::QUERY] = $queryParams;
        }

        if (!is_null($bodyJson)) {
            $options[RequestOptions::JSON] = $bodyJson;
        }

        if (!is_null($bodyFormParams)) {
            $options[RequestOptions::FORM_PARAMS] = $bodyFormParams;
        }

        return $options;
    }

    private function request(string $method, string $uri, array $options)
    {
        try {
            $response = $this->getClient()->request($method, $uri, $options);
            return $this->formatResponse($response);
        } catch (ClientException $e) {
            // error 4xx
            $this->resolveClientException($e, $options);
        } catch (ServerException | RequestException $e) {
            // error 5xx && other request error
            $this->resolveServerException($e, $options);
        }
    }

    private function formatResponse(Response $response)
    {
        $formatter = ResponseBuilder::build($response);
        return $formatter->format();
    }

    private function resolveClientException(ClientException $e, array $options)
    {
        $response = $e->getResponse();
        $statusCode = intval($response->getStatusCode());
        $body = $this->formatResponse($response);

        switch ($statusCode) {
            case HttpStatusCode::NOT_FOUND:
                $newException = new HttpNotFoundException(null, $e);
                break;
            case HttpStatusCode::UNAUTHORIZED:
                $newException = new HttpUnauthorizedException(null, $e);
                break;
            default:
                $newException = new HttpBadRequestException(null, $e);
                $newException->setStatusCode($statusCode);
                break;
        }

        throw ($newException)
            ->setBody($body)
            ->setContext(
                $this->buildContext($e, $options, $body, $statusCode)
            );
    }

    private function resolveServerException($e, array $options)
    {
        $response = $e->getResponse();
        $statusCode = intval($response->getStatusCode());
        $body = $this->formatResponse($response);

        throw (new HttpInternalServerErrorException(null, $e))
            ->setBody($body)
            ->setContext(
                $this->buildContext($e, $options, $body, $statusCode)
            );
    }

    private function buildContext(RequestException $e, array $options, $body, int $statusCode): array
    {
        $context = [
            'request' => [
                'uri' => $e->getRequest()->getUri()->__toString(),
                'method' => $e->getRequest()->getMethod(),
            ],
            'response' => $body,
            'statusCode' => $statusCode
        ];

        if (isset($options[RequestOptions::QUERY])) {
            $context['request'][RequestOptions::QUERY] = $options[RequestOptions::QUERY];
        }

        if (isset($options[RequestOptions::JSON])) {
            $context['request'][RequestOptions::JSON] = $options[RequestOptions::JSON];
        }

        if (isset($options[RequestOptions::FORM_PARAMS])) {
            $context['request'][RequestOptions::FORM_PARAMS] = $options[RequestOptions::FORM_PARAMS];
        }

        return $context;
    }
}