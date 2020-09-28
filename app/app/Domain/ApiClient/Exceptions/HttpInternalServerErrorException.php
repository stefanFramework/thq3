<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

class HttpInternalServerErrorException extends HttpException
{
    public const STATUS_CODE = 500;

    protected string $defaultMessage = '500 INTERNAL SERVER ERROR';

    protected int $statusCode = self::STATUS_CODE;
}
