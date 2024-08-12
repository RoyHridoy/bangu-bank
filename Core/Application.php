<?php

namespace App\Core;

use App\Models\User;

class Application
{
    public static $app = null;
    public Router $router;
    private Request $request;
    private Response $response;
    public Session $session;
    public User $user;

    private function __construct()
    {
        $this->request  = new Request;
        $this->response = new Response;
        $this->session  = new Session;
        $this->router   = new Router( $this->request, $this->response );
        $this->user     = new User;
    }

    public static function create()
    {
        if ( self::$app === null ) {
            self::$app = new self();
        }
        return self::$app;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function isAdmin()
    {
        return $this->user->isAdmin( $this->session->get( 'user' ) );
    }

    public function isCustomer()
    {
        return $this->user->isCustomer( $this->session->get( 'user' ) );
    }

    public function getUser()
    {
        return $this->user->getCurrentUser( $this->session->get( 'user' ) );
    }

    public function getAllUser( string $property )
    {
        return $this->user->getAllUser( $property );
    }

    public function getUserBy( string $property, $value )
    {
        return $this->user->getUserBy( $property, $value );
    }

}
