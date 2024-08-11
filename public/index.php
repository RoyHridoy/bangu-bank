<?php

use App\Core\Application;

define( "BASE_PATH", dirname( __DIR__ ) );

require_once BASE_PATH . "/vendor/autoload.php";

$app = Application::create();

$app->router->get( "/", function () {
    return "Homepage";
} );

// $app->router->get( "/contact", "contact" );

// $app->router->get( "/dashboard", [Dashboard::class, 'index'] );

$app->run();
