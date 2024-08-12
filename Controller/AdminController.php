<?php

namespace App\Controller;

use App\Core\Controller;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function customers()
    {
        $user = new User;
        return $this->render( "admin/customers", [
            'user' => $this->getUser(),
            'users' => $user->getAllUsers()
        ], "admin" );
    }

    public function transactions()
    {
        $transaction = new Transaction();

        return $this->render( "admin/transactions", [
            'user'  => $this->getUser(),
            'model' => $transaction,
        ], "admin" );
    }

    public function addCustomer()
    {
        return $this->render( "admin/add-customer", [
            'user' => $this->getUser(),
        ], "admin" );
    }
}
