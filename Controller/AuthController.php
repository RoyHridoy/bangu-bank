<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;

class AuthController extends Controller
{
    public function register( Request $request )
    {
        return $this->render( "register" );
    }

    public function login( Request $request )
    {
        return $this->render( "login" );
    }
}
