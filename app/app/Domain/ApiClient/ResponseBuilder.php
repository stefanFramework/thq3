<?php

declare(strict_types=1);

namespace App\Domain\ApiClient;

use GuzzleHttp\Psr7\Response;
use App\Domain\ApiClient\Exceptions\UnknownResponseFormatException;
use App\Domain\ApiClient\ResponseFormatter\ResponseFormatterInterface;
use App\Domain\ApiClient\ResponseFormatter\ResponseJson;
use App\Domain\ApiClient\ResponseFormatter\ResponseText;

class ResponseBuilder
{
    private static array $formatters = [
        'json' => ResponseJson::class,
        'text' => ResponseText::class
    ];

    public static function build(Response $response): ResponseFormatterInterface
    {
        $contentTypes = $response->getHeader('Content-Type');
        foreach (self::$formatters as $formatter) {
            if ($formatter::isValid($contentTypes)) {
                return new $formatter($response);
            }
        }

        throw (new UnknownResponseFormatException())
            ->setContext([
                'response_content_types' => $contentTypes
            ]);
    }
}
