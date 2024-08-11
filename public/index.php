<?php

use App\Controller\AuthController;
use App\Core\Application;

define( "BASE_PATH", dirname( __DIR__ ) );

require_once BASE_PATH . "/vendor/autoload.php";

$app = Application::create();

$app->router->get( "/contact", function () {
    return "contact";
} );

$app->router->get( "/", "home" );

$app->router->get( "/register", [AuthController::class, 'register'] );

$app->run();
