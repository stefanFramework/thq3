<?php

declare(strict_types=1);

namespace App\Domain\ApiClient;

final class ClientHeaders
{
    private const DEFAULT_HEADERS = [
        'Content-Type' => 'application/json'
    ];

    private array $headers = [];

    public function __construct(array $headers = [])
    {
        $this->headers = $headers + self::DEFAULT_HEADERS;
    }

    public function set(string $key, $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function get(string $key)
    {
        return $this->headers[$key] ?? null;
    }

    public function apiKey(string $apiKeyValue, ?string $key = 'X-Api-Key'): self
    {
        $this->set($key, $apiKeyValue);
        return $this;
    }

    public function __set(string $key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
