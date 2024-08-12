<?php

namespace App\Controller;

use App\Core\Controller;

class AdminController extends Controller
{
    public function customers()
    {
        return $this->render( "admin/customers", [
            'user' => $this->getUser(),
        ], "admin" );
    }

    public function transactions()
    {
        return $this->render( "admin/transactions", [
            'user' => $this->getUser(),
        ], "admin" );
    }

    public function addCustomer()
    {
        return $this->render( "admin/add-customer", [
            'user' => $this->getUser(),
        ], "admin" );
    }
}
