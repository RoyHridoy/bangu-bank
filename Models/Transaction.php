<?php

namespace App\Models;

use App\Core\Application;
use App\Core\DbModel;

class Transaction extends DbModel
{
    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_DEPOSIT  = 'deposit';

    public float $amount      = 0;
    public string $type       = '';
    public float $balance     = 0;
    public int $currentUserId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->currentUserId = Application::$app->getUser()['id'];
        $this->balance       = $this->getTotal( self::TYPE_DEPOSIT ) - $this->getTotal( self::TYPE_WITHDRAW );
    }

    public function tableName(): string
    {
        return "transactions";
    }

    public function rules(): array
    {
        return [
            "amount" => [self::RULE_REQUIRED, self::RULE_POSITIVE],
        ];
    }

    private function getTotal( string $type )
    {
        $transactionByCurrentUser = array_filter( $this->allData, fn( $transaction ) => $transaction['user_id'] === $this->currentUserId && $transaction['type'] === $type );
        $onlyAmounts              = array_column( $transactionByCurrentUser, 'amount' );
        return array_reduce( $onlyAmounts, fn( $acc, $curr ) => $acc + $curr, 0 );
    }

    public function getAllTransactions():array
    {
        return array_map( function ( $transaction ) {
            $transaction['user'] = $transaction['email'] === 'self' ? Application::$app->getUserBy( 'id', $transaction['user_id'] )[1] : Application::$app->getUserBy( 'email', $transaction['email'] )[1];
            return $transaction;
        }, $this->allData );
    }

    public function getAllTransactionByUserId( int $id )
    {
        return array_filter( $this->getAllTransactions(), fn( $transaction ) => $transaction['user_id'] === $id );
    }

    public function getAllTransactionByUserEmail( string $email )
    {
        return array_filter( $this->getAllTransactions(), fn( $transaction ) => $transaction['email'] === $email );
    }
}
