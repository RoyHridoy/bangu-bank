<?php
define( "BASE_PATH", dirname( __DIR__ ) );

use App\Core\ENVReader;
use App\Core\Migrations\FileMigration;
use App\Core\Migrations\MysqlMigration;

try {
    ENVReader::load();

    if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

        new FileMigration();

    } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

        new MysqlMigration();

    } else {

        printf( "⛔ Migration Failed.\n ⚠️ Check .env file and provide correct configuration\n" );
    }
} catch ( \Throwable $e ) {

    printf( "⛔ %s\n", $e->getMessage() );
}
