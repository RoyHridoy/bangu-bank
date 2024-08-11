<?php

namespace App\Core;

class Controller
{

    public function render( string $templateName, array $params = [], string $layout = "main" )
    {
        return Application::$app->router->renderView( $templateName, $params, $layout );
    }

    public function redirect( string $address )
    {
        Application::$app->router->redirect( $address );
    }

    public function setFlash( string $key, string $message ): void
    {
        Application::$app->session->setFlash( $key, $message );
    }
}
