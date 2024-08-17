<?php

use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Controller\CustomerController;
use App\Controller\HomeController;

return [
    ["get", "/", [HomeController::class, 'index'], []],

    ["post", "/logout", [AuthController::class, 'logout'], ["isAdmin"]],
    ["get", "/admin/customers", [AdminController::class, 'customers'], ["isAdmin"]],
    ["get", "/admin/transactions", [AdminController::class, 'transactions'], ["isAdmin"]],
    ["get", "/admin/customer-transactions/", [AdminController::class, 'customerTransactions'], ["isAdmin"]],
    ["get", "/admin/add-customer", [AdminController::class, 'addCustomer'], ["isAdmin"]],
    ["post", "/admin/add-customer", [AdminController::class, 'addCustomer'], ["isAdmin"]],
    ["get", "/admin/review-transactions", [AdminController::class, 'reviewTransactions'], ["isAdmin"]],
    ["post", "/admin/review-transactions", [AdminController::class, 'reviewTransactions'], ["isAdmin"]],

    ["post", "/logout", [AuthController::class, 'logout'], ["isCustomer"]],
    ["get", "/customer/dashboard", [CustomerController::class, 'dashboard'], ["isCustomer"]],
    ["get", "/customer/deposit", [CustomerController::class, 'deposit'], ["isCustomer"]],
    ["post", "/customer/deposit", [CustomerController::class, 'deposit'], ["isCustomer"]],
    ["get", "/customer/transfer", [CustomerController::class, 'transfer'], ["isCustomer"]],
    ["post", "/customer/transfer", [CustomerController::class, 'transfer'], ["isCustomer"]],
    ["get", "/customer/withdraw", [CustomerController::class, 'withdraw'], ["isCustomer"]],
    ["post", "/customer/withdraw", [CustomerController::class, 'withdraw'], ["isCustomer"]],

    ["get", "/register", [AuthController::class, 'register'], ["isNotAuthenticated"]],
    ["post", "/register", [AuthController::class, 'register'], ["isNotAuthenticated"]],
    ["get", "/login", [AuthController::class, 'login'], ["isNotAuthenticated"]],
    ["post", "/login", [AuthController::class, 'login'], ["isNotAuthenticated"]],
];
