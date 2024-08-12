<?php

namespace App\Models;

class Withdraw extends Transaction
{
    public string $email = 'self';

    public function withdraw( array $user )
    {
        $transaction = [
            'id'         => $this->generateId(),
            'user_id'    => $user['id'],
            'email'      => !empty( $this->email ) ? $this->email : 'self',
            'amount'     => $this->amount,
            'type'       => self::TYPE_WITHDRAW,
            'created_at' => time(),
        ];
        if($this->amount > $this->balance) {
            return "Insufficient Balance!";
        }
        $isTransactionSuccess = $this->save( $transaction );
        if ( !$isTransactionSuccess ) {
            return false;
        }
        return true;
    }
}
