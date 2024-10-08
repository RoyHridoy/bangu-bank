<?php

namespace App\Core;

class Request
{
    public function method(): string
    {
        return strtolower( $_SERVER['REQUEST_METHOD'] );
    }

    public function getPath(): string
    {
        return strtok( $_SERVER['REQUEST_URI'], "?" );
    }

    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    public function getBody(): array
    {
        $body = [];
        foreach ( $_REQUEST as $key => $value ) {
            $body[$key] = filter_var( $value, FILTER_SANITIZE_SPECIAL_CHARS );
        }
        return $body;
    }

    public function getQueryString()
    {
        return $_SERVER['QUERY_STRING'];
    }
}
