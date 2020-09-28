<?php

namespace App\Domain\ApiClient\Exceptions;

class HttpStatusCode
{
    const NOT_FOUND = '404';
    const UNAUTHORIZED = '401';
    const INTERNAL_SERVER_ERROR = '500';
}