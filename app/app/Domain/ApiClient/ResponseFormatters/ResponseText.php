<?php

declare(strict_types=1);

namespace App\Domain\ApiClient\ResponseFormatter;

class ResponseText extends BaseResponseFormatter
{
    protected const VALID_CONTENT_TYPE = 'text/html';

    public function format()
    {
        return $this->response->getBody()->getContents();
    }
}
