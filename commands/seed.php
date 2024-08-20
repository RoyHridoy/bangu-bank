<?php

use App\Core\ENVReader;
use App\Core\Seeder\FileSeeder;
use App\Core\Seeder\MysqlSeeder;

$tables = ['users', 'transactions'];

try {

    ENVReader::load();

    if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

        new FileSeeder( $tables );

    } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

        new MysqlSeeder( $tables );

    } else {

        printf( "⛔ Seeding Failed.\n ⚠️ Check .env file and provide correct configuration\n" );
    }

} catch ( \Throwable $e ) {
    printf( "%s", $e->getMessage() );
}
