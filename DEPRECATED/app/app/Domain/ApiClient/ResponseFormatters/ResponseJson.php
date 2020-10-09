<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\ResponseFormatter;

class ResponseJson extends BaseResponseFormatter
{
    protected const VALID_CONTENT_TYPE = 'application/json';

    public function format()
    {
        return json_decode($this->response->getBody()->getContents());
    }
}
