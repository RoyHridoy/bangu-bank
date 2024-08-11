<?php

namespace App\Core;

class Controller
{

    public function render( string $templateName, array $params = [], string $layout = "main" )
    {
        return Application::$app->router->renderView( $templateName, $params, $layout );
    }
}
