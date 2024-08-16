<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function customers()
    {
        $user        = new User;
        $transaction = new Transaction;
        return $this->render( "admin/customers", [
            'user'         => $this->getUser(),
            'users'        => $user->getAllUsers(),
            'totalInvalid' => count( $transaction->getInvalidTransitions() ),
        ], "admin" );
    }

    public function transactions()
    {
        $transaction = new Transaction();

        return $this->render( "admin/transactions", [
            'user'         => $this->getUser(),
            'transactions' => $transaction->getValidTransitions(),
            'totalInvalid' => count( $transaction->getInvalidTransitions() ),
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
            'totalInvalid' => count( $transaction->getInvalidTransitions() ),
        ], "admin" );
    }

    public function addCustomer( Request $request )
    {
        $user        = new User();
        $transaction = new Transaction;

        if ( $request->isPost() ) {

            $user->loadData( $request->getBody() );

            if ( $user->validate() && $user->register() ) {
                $this->setFlash( "success", "Registration has completed successfully." );
                $this->redirect( '/admin/customers' );
            }

            return $this->render( "admin/add-customer", [
                'user'         => $this->getUser(),
                'model'        => $user,
                'totalInvalid' => count( $transaction->getInvalidTransitions() ),
            ], "admin" );
        }

        return $this->render( "admin/add-customer", [
            'user'         => $this->getUser(),
            'model'        => $user,
            'totalInvalid' => count( $transaction->getInvalidTransitions() ),
        ], "admin" );
    }

    public function reviewTransactions( Request $request )
    {
        $transaction = new Transaction();
        $review      = new Review;

        if ( $request->isPost() ) {

            $transaction->loadData( $request->getBody() );
            $review->loadData( $request->getBody() );

            if ( $review->validate() && $review->review() ) {
                $this->setFlash( "success", "Deposited money is approved." );
                $this->redirect( '/admin/review-transactions' );
            } else {
                $this->setFlash( "error", "Deposited Transaction is discarded." );
                $this->redirect( '/admin/review-transactions' );
            }

            return $this->render( "admin/review-transaction", [
                'user'         => $this->getUser(),
                'transactions' => $transaction->getInvalidTransitions(),
                'totalInvalid' => count( $transaction->getInvalidTransitions() ),
            ], "admin" );
        }

        return $this->render( "admin/review-transaction", [
            'user'         => $this->getUser(),
            'transactions' => $transaction->getInvalidTransitions(),
            'totalInvalid' => count( $transaction->getInvalidTransitions() ),
        ], "admin" );
    }
}
