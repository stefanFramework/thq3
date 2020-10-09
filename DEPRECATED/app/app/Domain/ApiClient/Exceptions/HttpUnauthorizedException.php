<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

class HttpUnauthorizedException extends HttpException
{
    public const STATUS_CODE = 401;

    protected string $defaultMessage = '401 UNAUTHORIZED';

    protected int $statusCode = self::STATUS_CODE;
}
