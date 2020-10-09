<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

use App\Domain\Exceptions\GenericException;

abstract class HttpException extends GenericException
{
    public const STATUS_CODE = 0;

    protected const MESSAGE_PREFIX = 'ApiClientException';
 
    protected string $defaultMessage = 'HTTP Exception';

    protected int $statusCode = self::STATUS_CODE;

    protected $bodyResponse = '';

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setBody($body): self
    {
        $this->bodyResponse = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->bodyResponse;
    }
}
