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
            return $this->renderView( "404" );
        }

        if ( is_string( $action ) ) {
            return $this->renderView( $action );
        }

        if ( is_array( $action ) ) {
            $action[0] = new $action[0];
        }

        return call_user_func( $action, $this->request );
    }

    public function renderView( string $templateName, array $params = [], string $layout = "main" )
    {
        $layout  = $this->loadLayout( $layout, $params );
        $content = $this->loadContent( $templateName, $params );
        return str_replace( "{{content}}", $content, $layout );
    }

    private function loadContent( string $templateName, array $params )
    {
        foreach ( $params as $key => $value ) {
            $$key = $value;
        }
        ob_start();
        include_once BASE_PATH . "/Views/{$templateName}.view.php";
        return ob_get_clean();
    }

    private function loadLayout( string $layout, array $params )
    {
        foreach ( $params as $key => $value ) {
            $$key = $value;
        }
        ob_start();
        include_once BASE_PATH . "/Views/layouts/{$layout}.view.php";
        return ob_get_clean();
    }

    public function redirect( string $address )
    {
        $this->response->redirect( $address );
    }
}
