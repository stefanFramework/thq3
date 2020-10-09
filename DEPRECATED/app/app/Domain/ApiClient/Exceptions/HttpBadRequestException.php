<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

class HttpBadRequestException extends HttpException
{
    public const STATUS_CODE = 400;

    protected string $defaultMessage = '400 BAD REQUEST';

    protected int $statusCode = self::STATUS_CODE;
}
