<?php

namespace App\Models;

use App\Core\DbModel;

class Review extends DbModel
{
    const STATUS_VALID   = 1;
    const STATUS_INVALID = 0;

    public int $status        = 0;
    public int $transactionId = 0;
    public function rules(): array
    {
        return [
            "status"        => [self::RULE_REQUIRED, self::RULE_NUMBER],
            "transactionId" => [self::RULE_REQUIRED, self::RULE_NUMBER, self::RULE_POSITIVE],
        ];
    }

    public function tableName(): string
    {
        return "transactions";
    }

    public function review()
    {
        $transaction = $this->findOrFail( 'id', $this->transactionId );
        if ( $this->status === self::STATUS_VALID ) {
            $this->approveItem( $transaction );
            return true;
        }

        $this->removeItem( $transaction );
        return false;
    }
}
