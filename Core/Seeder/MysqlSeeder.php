<?php

namespace App\Core\Seeder;

use App\Core\Database;
use PDO;

class MysqlSeeder
{
    private $pdo;

    public function __construct( array $tables )
    {
        try {

            $db        = Database::getInstance();
            $this->pdo = $db->getPdo();
            $this->seedData( $tables );

        } catch ( \Throwable $e ) {

            $this->showMessage( $e->getMessage(), "⛔" );
        }
    }

    private function seedData( array $tables )
    {
        foreach ( $tables as $table ) {
            $data = array_map( function ( $row ) {

                unset( $row['id'] );
                unset( $row['created_at'] );
                return $row;

            }, $this->readSeedingData( $table ) );

            $columns = $this->getDbColumnNames( $table );

            $stmt = $this->pdo->prepare( "INSERT INTO $table (" . join( ", ", $columns ) . ") VALUES (:" . join( " ,:", $columns ) . ")" );

            $this->pdo->beginTransaction();
            foreach ( $data as $row ) {
                $stmt->execute( $row );
            }
            $isSuccess = $this->pdo->commit();

            if ( $isSuccess ) {
                $this->showMessage( "Successfully Seed {$table} table", "✅" );
            }
        }
    }

    private function readSeedingData( string $tableName )
    {
        $data = file_get_contents( BASE_PATH . "/seed/$tableName.txt" );
        return json_decode( $data, true );
    }

    private function getDbColumnNames( string $tableName ): array
    {
        $stmt = $this->pdo->query( "SHOW COLUMNS FROM $tableName" );
        return array_diff( $stmt->fetchAll( PDO::FETCH_COLUMN ), ['id', 'created_at'] );
    }

    private function showMessage( string $message, string $icon = "" )
    {
        printf( "%s %s\n", $icon, $message );
    }
}
