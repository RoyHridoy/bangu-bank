<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Withdraw;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $transaction = new Transaction();

        return $this->render( "/customer/dashboard", [
            'user'  => $this->getUser(),
            'model' => $transaction,
            'transactions' => $transaction->getAllTransactionByUserId($this->getUser()['id']),
        ], "customer" );
    }

    public function deposit( Request $request )
    {
        $transaction = new Deposit();
        if ( $request->isPost() ) {

            $transaction->loadData( $request->getBody() );

            if ( $transaction->validate() && $transaction->deposit( $this->getUser() ) ) {
                $this->setFlash( "success", "You have successfully deposited your money." );
                $this->redirect( '/customer/dashboard' );
            }

            return $this->render( "/customer/deposit", [
                'user'  => $this->getUser(),
                'model' => $transaction,
            ], "customer" );
        }

        return $this->render( "/customer/deposit", [
            'user'  => $this->getUser(),
            'model' => $transaction,
        ], "customer" );
    }

    public function withdraw( Request $request )
    {
        $transaction = new Withdraw();
        if ( $request->isPost() ) {

            $transaction->loadData( $request->getBody() );

            if ( $transaction->validate() && ( $transaction->withdraw( $this->getUser() ) === true ) ) {
                $this->setFlash( "success", "You have successfully withdraw your money." );
                $this->redirect( '/customer/dashboard' );
                return;
            }

            if ( $transaction->validate() && ( is_string( $transaction->withdraw( $this->getUser() ) ) ) ) {
                $this->setFlash( "error", $transaction->withdraw( $this->getUser() ) );
                $this->redirect( '/customer/dashboard' );
            }

            return $this->render( "/customer/withdraw", [
                'user'  => $this->getUser(),
                'model' => $transaction,
            ], "customer" );
        }

        return $this->render( "/customer/withdraw", [
            'user'  => $this->getUser(),
            'model' => $transaction,
        ], "customer" );
    }

    public function transfer( Request $request )
    {
        $transaction = new Transfer();

        if ( $request->isPost() ) {

            $transaction->loadData( $request->getBody() );

            if ( $transaction->validate() && ( $transaction->transfer( $this->getUser() ) === true ) ) {
                $this->setFlash( "success", "You have successfully transfer your money." );
                $this->redirect( '/customer/dashboard' );
                return;
            }

            if ( $transaction->validate() && ( is_string( $transaction->transfer( $this->getUser() ) ) ) ) {
                $this->setFlash( "error", $transaction->transfer( $this->getUser() ) );
                $this->redirect( '/customer/dashboard' );
            }

            return $this->render( "/customer/transfer", [
                'user'  => $this->getUser(),
                'model' => $transaction,
            ], "customer" );
        }

        return $this->render( "/customer/transfer", [
            'user'  => $this->getUser(),
            'model' => $transaction,
        ], "customer" );
    }
}
