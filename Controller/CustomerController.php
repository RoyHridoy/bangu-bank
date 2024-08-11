<?php

namespace App\Controller;

use App\Core\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return $this->render( "/customer/dashboard", [], "customer" );
    }

    public function deposit()
    {
        return $this->render( "/customer/deposit", [], "customer" );
    }

    public function transfer()
    {
        return $this->render( "/customer/transfer", [], "customer" );
    }

    public function withdraw()
    {
        return $this->render( "/customer/withdraw", [], "customer" );
    }
}
