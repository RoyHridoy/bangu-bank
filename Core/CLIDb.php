<?php

namespace App\Core;

define( "DB_PATH", BASE_PATH . "/Database//" );
class CLIDb
{
    public string $tablePath;
    public array $allData;
    public string $tableName;
    protected $pdo;
    public function __construct( string $tableName )
    {
        ENVReader::load();
        $this->tableName = $tableName;

        try {
        
            if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

                $this->tablePath = DB_PATH . $this->tableName . ".txt";
                $this->fetchAllData();

            } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

                $db        = Database::getInstance();
                $this->pdo = $db->getPdo();
                $this->fetchAllData();

            } else {
                echo "Unable to connect Database. Check .env file configuration.";
            }

        } catch ( \Throwable $e ) {
            echo $e->getMessage();
        }

    }

    private function fetchAllData(): void
    {
        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

            $this->allData = json_decode( file_get_contents( $this->tablePath ), true );

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $stmt = $this->pdo->prepare( "SELECT * FROM {$this->tableName}" );
            $stmt->execute();
            $this->allData = $stmt->fetchAll();

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
        }
    }

    public function getAllByPropertyName( string $property ): array
    {
        return array_column( $this->allData, $property );
    }

    public function findOrFail( string $property, string | int $value ): array | bool
    {
        $user = array_filter( (array) $this->allData, fn( array $user ) => $user[$property] === $value );
        if ( empty( $user ) ) {
            return false;
        }
        foreach ( $user as $index => $value ) {
            return [$index, $value];
        }
    }

    public function createAdmin( array $user )
    {
        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {
            $index = $user[0];

            $this->allData[$index]['role'] = 'admin';
            return $this->storeData();

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $userId = $user[1]['id'];

            $sql  = "UPDATE {$this->tableName} SET role = :role WHERE id = :id";
            $stmt = $this->pdo->prepare( $sql );
            return $stmt->execute( ['role' => 'admin', 'id' => $userId] );

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
        }
    }

    private function storeData()
    {
        return file_put_contents( $this->tablePath, json_encode( $this->allData ), LOCK_EX );
    }
}
