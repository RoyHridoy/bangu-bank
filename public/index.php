<?php

use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Controller\CustomerController;
use App\Controller\HomeController;
use App\Core\Application;

define( "BASE_PATH", dirname( __DIR__ ) );

require_once BASE_PATH . "/vendor/autoload.php";

$app = Application::create();

$app->router->get( "/contact", function () {
    return "contact";
} );

$app->router->get( "/", [HomeController::class, 'index'] );

if ( $app->isAdmin() ) {
    $app->router->post( "/logout", [AuthController::class, 'logout'] );
    $app->router->get( "/admin/customers", [AdminController::class, 'customers'] );
    $app->router->get( "/admin/transactions", [AdminController::class, 'transactions'] );
    $app->router->get( "/admin/customer-transactions/", [AdminController::class, 'customerTransactions'] );
    $app->router->get( "/admin/add-customer", [AdminController::class, 'addCustomer'] );
    $app->router->post( "/admin/add-customer", [AdminController::class, 'addCustomer'] );
    $app->router->get( "/admin/review-transactions", [AdminController::class, 'reviewTransactions'] );
    $app->router->post( "/admin/review-transactions", [AdminController::class, 'reviewTransactions'] );
}

if ( $app->isCustomer() ) {
    $app->router->post( "/logout", [AuthController::class, 'logout'] );
    $app->router->get( "/customer/dashboard", [CustomerController::class, 'dashboard'] );
    $app->router->get( "/customer/deposit", [CustomerController::class, 'deposit'] );
    $app->router->post( "/customer/deposit", [CustomerController::class, 'deposit'] );
    $app->router->get( "/customer/transfer", [CustomerController::class, 'transfer'] );
    $app->router->post( "/customer/transfer", [CustomerController::class, 'transfer'] );
    $app->router->get( "/customer/withdraw", [CustomerController::class, 'withdraw'] );
    $app->router->post( "/customer/withdraw", [CustomerController::class, 'withdraw'] );
}

if ( !$app->isAdmin() && !$app->isCustomer() ) {
    $app->router->get( "/register", [AuthController::class, 'register'] );
    $app->router->post( "/register", [AuthController::class, 'register'] );
    $app->router->get( "/login", [AuthController::class, 'login'] );
    $app->router->post( "/login", [AuthController::class, 'login'] );
}

$app->run();
