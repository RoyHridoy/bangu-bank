<?php
namespace App\Core;

abstract class DbModel extends Model
{
    public function save( $data ): bool
    {
        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

            $this->insertItem( $data );
            return $this->storeData();

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $data    = array_diff_key( $data, ['id' => true, "created_at" => true] );
            $columns = $this->getDbColumnNames( $this->tableName() );

            $sql  = "INSERT INTO {$this->tableName()}(" . join( ", ", $columns ) . ") VALUES (:" . join( ", :", $columns ) . ")";
            $stmt = $this->pdo->prepare( $sql );
            return $stmt->execute( $data );

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
            return false;
        }
    }

    private function storeData()
    {
        return file_put_contents( $this->tablePath, json_encode( $this->allData ), LOCK_EX );
    }

    private function insertItem( $data )
    {
        array_push( $this->allData, $data );
    }

    public function generateId(): int
    {
        if ( !$this->getAllByPropertyName( "id" ) ) {
            return 1;
        }
        $maxId = max( $this->getAllByPropertyName( "id" ) );
        return $maxId + 1;
    }

    public function removeItem( array $transaction )
    {

        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {
            $index = $transaction[0];
            array_splice( $this->allData, $index, 1 );
            return $this->storeData();

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $transactionId = $transaction[1]['id'];

            $sql  = "DELETE FROM {$this->tableName()} WHERE id = :id";
            $stmt = $this->pdo->prepare( $sql );
            return $stmt->execute( ['id' => $transactionId] );

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
            return false;
        }
    }

    public function approveItem( array $transaction )
    {
        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {
            $index                           = $transaction[0];
            $this->allData[$index]['status'] = 1;
            return $this->storeData();

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $transactionId = $transaction[1]['id'];

            $sql  = "UPDATE {$this->tableName()} SET status = :status WHERE id = :id";
            $stmt = $this->pdo->prepare( $sql );
            return $stmt->execute( ['status' => 1, 'id' => $transactionId] );

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
            return false;
        }
    }
}
