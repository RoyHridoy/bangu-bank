<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Login;
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
        $loginUser = new Login;

        if ( $request->isPost() ) {

            $loginUser->loadData( $request->getBody() );

            if ( $loginUser->validate() && !$loginUser->login() ) {
                $this->setFlash( "error", "Wrong Credential. Please try again valid email and password." );
            }
            if ( $loginUser->validate() && $loginUser->login() ) {
                $this->redirect( '/' );
            }

            return $this->render( "login", ['model' => $loginUser] );
        }

        return $this->render( "login", ['model' => $loginUser] );
    }

    public function logout(): void
    {
        $this->destroySession();
        $this->redirect( '/' );
    }
}
