<?php

namespace App\Core;

class Session
{
    protected const FLASH = 'flash';
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH] ?? [];

        foreach ( $flashMessages as $key => &$flashMessage ) {
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH] = $flashMessages;
    }

    public function setFlash( string $key, string $message ): void
    {
        $_SESSION[self::FLASH][$key] = [
            'remove' => false,
            'value'  => $message,
        ];
    }

    public function getFlash( string $key ): string
    {
        return $_SESSION[self::FLASH][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH] ?? [];

        foreach ( $flashMessages as $key => &$flashMessage ) {
            if ( $flashMessage['remove'] === true ) {
                unset( $flashMessages[$key] );
            }
        }
        $_SESSION[self::FLASH] = $flashMessages;
    }
}
