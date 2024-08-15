<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function customers()
    {
        $user = new User;
        return $this->render( "admin/customers", [
            'user'  => $this->getUser(),
            'users' => $user->getAllUsers(),
        ], "admin" );
    }

    public function transactions()
    {
        $transaction = new Transaction();

        return $this->render( "admin/transactions", [
            'user'         => $this->getUser(),
            'transactions' => $transaction->getAllTransactions(),
        ], "admin" );
    }

    public function customerTransactions( Request $request )
    {
        $transaction = new Transaction();

        $customerId = (int) str_replace( "userId=", "", $request->getQueryString() );

        return $this->render( "admin/customer-transactions", [
            'user'         => $this->getUser(),
            'customer'     => $this->getUserById( $customerId )[1],
            'transactions' => array_reverse( $transaction->getAllTransactionByUserId( $customerId ) ),
        ], "admin" );
    }

    public function addCustomer( Request $request )
    {
        $user = new User();

        if ( $request->isPost() ) {

            $user->loadData( $request->getBody() );

            if ( $user->validate() && $user->register() ) {
                $this->setFlash( "success", "Registration has completed successfully." );
                $this->redirect( '/admin/customers' );
            }

            return $this->render( "admin/add-customer", [
                'user'  => $this->getUser(),
                'model' => $user,
            ], "admin" );
        }

        return $this->render( "admin/add-customer", [
            'user'  => $this->getUser(),
            'model' => $user,
        ], "admin" );
    }
}
