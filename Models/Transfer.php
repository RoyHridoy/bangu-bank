<?php

namespace App\Models;

class Transfer extends Transaction
{
    public string $email = '';

    public function rules(): array
    {
        return [
            "amount" => [self::RULE_REQUIRED, self::RULE_POSITIVE],
            "email"  => [self::RULE_REQUIRED, self::RULE_EMAIL],
        ];
    }

    public function transfer( array $user )
    {
        $transaction = [
            'id'         => $this->generateId(),
            'user_id'    => $user['id'],
            'email'      => $this->email,
            'amount'     => $this->amount,
            'type'       => self::TYPE_WITHDRAW,
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
