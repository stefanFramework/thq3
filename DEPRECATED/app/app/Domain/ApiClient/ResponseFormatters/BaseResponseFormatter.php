<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\ResponseFormatter;

use GuzzleHttp\Psr7\Response;

abstract class BaseResponseFormatter implements ResponseFormatterInterface
{
    protected const VALID_CONTENT_TYPE = '';

    protected Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    abstract public function format();

    public static function isValid(array $contentTypes): bool
    {
        foreach ($contentTypes as $contentType) {
            if (strripos($contentType, static::VALID_CONTENT_TYPE) !== false) {
                return true;
            }
        }
        return false;
    }
}
