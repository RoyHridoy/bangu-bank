<?php

namespace App\Core;

define( "DB_PATH", BASE_PATH . "/Database//" );
class CLI
{
    public string $tablePath;
    public array $allData;
    public string $tableName;
    public function __construct( string $tableName )
    {
        $this->tableName = $tableName;
        $this->tablePath = DB_PATH . $this->tableName . ".txt";
        $this->fetchAllData();
    }

    private function fetchAllData(): void
    {
        $this->allData = json_decode( file_get_contents( $this->tablePath ), true );
    }

    public function getAllByPropertyName( string $property ): array
    {
        return array_column( $this->allData, $property );
    }

    public function findOrFail( string $property, string | int $value ): array | bool
    {
        $user = array_filter( (array) $this->allData, fn( array $user ) => $user[$property] === $value );
        return empty( $user ) ? false : $user;
    }

    public function createAdmin( int $index )
    {
        $this->allData[$index]['role'] = 'admin';
        return $this->storeData();
    }

    private function storeData()
    {
        return file_put_contents( $this->tablePath, json_encode( $this->allData ), LOCK_EX );
    }
}
