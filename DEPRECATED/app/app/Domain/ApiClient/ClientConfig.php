<?php

declare(strict_types=1);

namespace App\Domain\ApiClient;

use RuntimeException;
use Illuminate\Support\Facades\Config;

final class ClientConfig
{
    private array $config = [];

    private ClientHeaders $headers;

    public function __construct(array $config = [])
    {
        $config = $this->buildHeaders($config);

        $this->config = $config + $this->getDefaultConfig();
    }

    private function getDefaultConfig(): array
    {
        return [
            'base_uri' => '',
            'verify' => false,
            'timeout' => Config::get('api.timeout'),
            'connect_timeout' => Config::get('api.connect_timeout')
        ];
    }

    private function buildHeaders(array $config): array
    {
        if (!isset($config['headers'])) {
            $this->headers = new ClientHeaders();
            return $config;
        }

        $h = $config['headers'];
        $this->headers = ($h instanceof ClientHeaders) ? $h : new ClientHeaders($h);
        unset($config['headers']);

        return $config;
    }

    public function set(string $key, $value): self
    {
        if ($key === 'headers') {
            $this->buildHeaders(['headers' => $value]);
            return $this;
        }

        $this->config[$key] = $value;
        return $this;
    }

    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }

    public function __call(string $method, array $params)
    {
        if (substr($method, 0, 9) == 'setHeader') {
            return $this->setHeaderMethod(substr($method, 9), $params);
        }

        throw new RuntimeException('Call invalid method \`$method\` in class ' . self::class);
    }

    private function setHeaderMethod(string $method, array $params)
    {
        return call_user_func_array([$this->headers, $method], $params);
    }

    public function setHeaders(string $header, $value): self
    {
        $this->headers->set($header, $value);
        return $this;
    }

    public function getHeaders(): ClientHeaders
    {
        return $this->headers;
    }

    public function toArray(): array
    {
        return $this->config + ['headers' => $this->headers->toArray()];
    }
}
