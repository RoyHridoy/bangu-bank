<?php

namespace App\Core;

class Response
{
    public function setStatusCode( int $code ): void
    {
        http_response_code( $code );
    }

    public function redirect( string $address ): void
    {
        header( "location: {$address}" );
    }
}
