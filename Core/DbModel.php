<?php
namespace App\Core;

abstract class DbModel extends Model
{
    public function save( $data ): bool
    {
        $this->insertItem( $data );
        return $this->storeData();
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

    public function removeItem( int $index )
    {
        array_splice( $this->allData, $index, 1 );
        return $this->storeData();
    }

    public function approveItem( int $index )
    {
        $this->allData[$index]['status'] = 1;
        return $this->storeData();
    }

}
