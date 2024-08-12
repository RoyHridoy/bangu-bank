<?php

namespace App\Models;

class Deposit extends Transaction
{
    public string $email = 'self';

    public function deposit( array $user )
    {
        $transaction = [
            'id'         => $this->generateId(),
            'user_id'    => $user['id'],
            'email'      => $this->email,
            'amount'     => $this->amount,
            'type'       => self::TYPE_DEPOSIT,
            'created_at' => time(),
        ];
        // dd( $transaction, date( "F j, Y, g:i:s a", 1723468595 ) );
        $isTransactionSuccess = $this->save( $transaction );
        if ( !$isTransactionSuccess ) {
            return false;
        }
        return true;
    }
}
