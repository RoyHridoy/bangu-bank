<?php

namespace App\Core;

class Application
{
    private static $app = null;
    public Router $router;
    private Request $request;
    private Response $response;

    private function __construct()
    {
        $this->request  = new Request;
        $this->response = new Response;
        $this->router   = new Router( $this->request, $this->response );
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
}
