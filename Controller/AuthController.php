<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register( Request $request )
    {
        $user = new User();

        if ( $request->isPost() ) {

            $user->loadData( $request->getBody() );

            if ( $user->validate() && $user->register() ) {
                $this->setFlash( "success", "Thanks for registration. Please login to continue." );
                $this->redirect( '/login' );
            }

            return $this->render( "register", ['model' => $user] );
        }

        return $this->render( "register", ['model' => $user] );
    }

    public function login( Request $request )
    {
        return $this->render( "login" );
    }
}
