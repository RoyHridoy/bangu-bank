<?php

namespace App\Core\Seeder;

use Exception;

class FileSeeder
{
    public function __construct( array $tables )
    {
        foreach ( $tables as $table ) {
            $tableLocation  = BASE_PATH . "/Database/{$table}.txt";
            $seederLocation = BASE_PATH . "/seed/{$table}.txt";

            if ( !file_exists( $tableLocation ) ) {
                throw new Exception( "{$table} Table Not Found! Migrate First." );
            }

            if ( copy( $seederLocation, $tableLocation ) ) {

                $this->showMessage( "Seed {$table} table successfully.", "✅" );

            } else {

                $this->showMessage( "Failed to seed {$table} table." );
            }
        }
    }

    private function showMessage( string $message, string $icon = "" )
    {
        printf( "%s %s\n", $icon, $message );
    }
}
