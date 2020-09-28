<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

class HttpNotFoundException extends HttpException
{
    public const STATUS_CODE = 404;

    protected string $defaultMessage = '404 NOT FOUND';

    protected int $statusCode = self::STATUS_CODE;
}
