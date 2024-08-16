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
            'status'     => self::STATUS_INVALID,
            'created_at' => time(),
        ];
        $isTransactionSuccess = $this->save( $transaction );
        if ( !$isTransactionSuccess ) {
            return false;
        }
        return true;
    }
}
