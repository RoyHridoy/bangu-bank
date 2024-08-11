<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    public function __construct( Request $request, Response $response )
    {

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
        
        dd($this->routes);
        return "hello";
    }
}
