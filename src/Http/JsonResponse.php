<?php

namespace Http;

class JsonResponse
{
    public function __construct($content, $statusCode = 200, array $headers = [])
    {
        $this->content    = $content;
        $this->statusCode = $statusCode;
        $this->headers    = array_merge([ 'Content-Type' => 'application/json' ], $headers);
    }
}