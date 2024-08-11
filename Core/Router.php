<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;
    public function __construct( Request $request, Response $response )
    {
        $this->request  = $request;
        $this->response = $response;
    }

    public function get( string $path, $action ): void
    {
        $this->routes['get'][$path] = $action;
    }

    public function post( string $path, $action ): void
    {
        $this->routes['post'][$path] = $action;
    }

    public function resolve()
    {
        $path   = $this->request->getPath();
        $method = $this->request->method();
        $action = $this->routes[$method][$path] ?? false;
        if ( $action === false ) {
            $this->response->setStatusCode( 404 );
            return "Not Found";
        }

        if ( is_string( $action ) ) {
            return "view";
        }

        if ( is_array( $action ) ) {
            $action[0] = new $action[0];
        }

        return call_user_func( $action, $this->request );
    }
}
