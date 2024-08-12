<?php

namespace App\Models;

use App\Core\Application;

class Transfer extends Transaction
{
    public string $email = '';

    public function rules(): array
    {
        return [
            "amount" => [self::RULE_REQUIRED, self::RULE_POSITIVE],
            "email"  => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EXIST, self::RULE_RESTRICT_SELF],
        ];
    }

    public function transfer( array $user )
    {
        $senderTransaction = [
            'id'         => $this->generateId(),
            'user_id'    => $user['id'],
            'email'      => $this->email,
            'amount'     => $this->amount,
            'type'       => self::TYPE_WITHDRAW,
            'created_at' => time(),
        ];
        if ( $this->amount > $this->balance ) {
            return "Insufficient Balance!";
        }
        $receiverTransaction = [
            'id'         => $this->generateId() + 1,
            'user_id'    => Application::$app->getUserBy( 'email', $this->email )[1]['id'],
            'email'      => Application::$app->getUser()['email'],
            'amount'     => $this->amount,
            'type'       => self::TYPE_DEPOSIT,
            'created_at' => time(),
        ];
        $isSentTransaction    = $this->save( $senderTransaction );
        $isReceiveTransaction = $this->save( $receiverTransaction );
        if ( !$isSentTransaction && !$isReceiveTransaction ) {
            return false;
        }
        return true;
    }

}
