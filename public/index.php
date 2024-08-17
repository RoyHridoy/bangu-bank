<?php

use App\Core\Application;

define( "BASE_PATH", dirname( __DIR__ ) );

require_once BASE_PATH . "/vendor/autoload.php";

$app = Application::create();

$app->loadRoutes();

$app->run();
