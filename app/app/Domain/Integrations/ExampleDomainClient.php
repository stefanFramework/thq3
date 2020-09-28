<?php

declare(strict_types=1);

namespace App\Domain\Integrations;

use Throwable;

use App\Domain\ApiClient\Client;
use App\Domain\ApiClient\ClientConfig;
use App\Domain\ApiClient\ClientHeaders;
use App\Domain\ApiClient\Exceptions\HttpException;

class ExampleDomainClient
{
    private const PATH = '';
    
    public function getClient(): Client
    {
        /** @var ?Client $client */
        static $client = null;

        if (is_null($client)) {
            $clientHeaders = new ClientHeaders();
            $clientHeaders->apiKey($this->getApiKey());
            
            $clientConfig = new ClientConfig([
                'base_uri' => $this->getBaseUri(),
                'headers' => $clientHeaders
            ]);

            $client = new Client($clientConfig);
        }

        return $client;
    }

    public function example()
    {
        $data = [];

        try {
            return $this->getClient()->post(
                self::PATH,
                null,
                $data
            );
        } catch (HttpException $e) {
            // Do something
        } catch (Throwable $e) {
            // Do something
        } 
    }

    private function getApiKey(): string
    {
        return '';
    }

    private function getBaseUri(): string
    {
        return '' . '/';
    }
}
