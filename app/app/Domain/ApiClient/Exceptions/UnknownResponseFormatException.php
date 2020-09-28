<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\Exceptions;

class UnknownResponseFormatException extends HttpException
{
    protected string $defaultMessage = 'Unknown format';
}
