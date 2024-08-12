<?php

namespace App\Controller;

use App\Core\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return $this->render( "/customer/dashboard", [
            'user' => $this->getUser(),
        ], "customer" );
    }

    public function deposit()
    {
        return $this->render( "/customer/deposit", [
            'user' => $this->getUser(),
        ], "customer" );
    }

    public function transfer()
    {
        return $this->render( "/customer/transfer", [
            'user' => $this->getUser(),
        ], "customer" );
    }

    public function withdraw()
    {
        return $this->render( "/customer/withdraw", [
            'user' => $this->getUser(),
        ], "customer" );
    }
}
