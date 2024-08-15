<?php
$tables         = ['users', 'transactions'];
$userDb         = __DIR__ . "/Database/users.txt";
$transactionsDb = __DIR__ . "/Database/transactions.txt";

$dummyUsers = file_get_contents( __DIR__ . "/seed/users.txt" );

$dummyTransactions = file_get_contents( __DIR__ . "/seed/transactions.txt" );

try {

    foreach ( $tables as $table ) {
        $tableLocation  = __DIR__ . "/Database/{$table}.txt";
        $seederLocation = __DIR__ . "/seed/{$table}.txt";

        if ( !file_exists( $tableLocation ) ) {
            throw new Exception( "{$table} Table Not Found! Migrate First." );
        }

        if ( copy( $seederLocation, $tableLocation ) ) {
            echo "Seed {$table} table successfully.";
        } else {
            echo "Failed to seed {$table} table.";
        }
    }

} catch ( \Throwable $e ) {
    printf( "%s", $e->getMessage() );
}
