<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\ResponseFormatter;

interface ResponseFormatterInterface
{
    public function format();

    public static function isValid(array $contentTypes): bool;
}
