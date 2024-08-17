<?php

namespace App\Core;

class ENVReader
{
    private static $instance = null;
    private function __construct()
    {
        $fp = fopen( BASE_PATH . "/.env", 'r' );
        while ( $line = fgets( $fp ) ) {
            $line = trim( $line );
            if ( $line === "" || $line[0] === '#' ) {
                continue;
            }
            [$key, $value]    = explode( "=", $line );
            $_ENV[trim( $key )] = trim( $value );
        }
    }

    public static function load()
    {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
