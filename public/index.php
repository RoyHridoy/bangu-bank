<?php

use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Controller\CustomerController;
use App\Core\Application;

define( "BASE_PATH", dirname( __DIR__ ) );

require_once BASE_PATH . "/vendor/autoload.php";

$app = Application::create();

$app->router->get( "/contact", function () {
    return "contact";
} );

$app->router->get( "/", "home" );
$app->router->get( "/register", [AuthController::class, 'register'] );
$app->router->post( "/register", [AuthController::class, 'register'] );
$app->router->get( "/login", [AuthController::class, 'login'] );
$app->router->get( "/admin/customers", [AdminController::class, 'customers'] );
$app->router->get( "/admin/transactions", [AdminController::class, 'transactions'] );
$app->router->get( "/admin/add-customer", [AdminController::class, 'addCustomer'] );
$app->router->get( "/customer/dashboard", [CustomerController::class, 'dashboard'] );
$app->router->get( "/customer/deposit", [CustomerController::class, 'deposit'] );
$app->router->get( "/customer/transfer", [CustomerController::class, 'transfer'] );
$app->router->get( "/customer/withdraw", [CustomerController::class, 'withdraw'] );

$app->run();
