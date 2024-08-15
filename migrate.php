<?php

try {
    $isDirectoryCreated = mkdir( "Database" );

    if ( !$isDirectoryCreated ) {
        throw new Exception( "Permission Denied or Database Directory Already Exists when creating folder!\n" );
    }

    $isUserDbCreated = file_put_contents( __DIR__ . "/Database/users.txt", "[]" );
    if ( !$isUserDbCreated ) {
        throw new Exception( "Permission Denied when creating user database!" );
    }

    $isTransactionDbCreated = file_put_contents( __DIR__ . "/Database/transactions.txt", "[]" );
    if ( !$isTransactionDbCreated ) {
        throw new Exception( "Permission Denied when creating transaction database!" );
    }
    printf( "✅ Successfully Created Migrations\n" );
} catch ( \Throwable $e ) {
    printf( "⛔ %s", $e->getMessage() );
}
