<?php

namespace App\Core\Migrations;

use Exception;

class FileMigration
{
    public function __construct()
    {
        $folderName         = "Database";
        $isDirectoryCreated = mkdir( BASE_PATH . "/$folderName" );

        if ( !$isDirectoryCreated ) {
            throw new Exception( "Permission Denied or Database Directory Already Exists when creating folder!\n" );
        }

        $isUserDbCreated = file_put_contents( BASE_PATH . "/$folderName/users.txt", "[]" );
        if ( !$isUserDbCreated ) {
            throw new Exception( "Permission Denied when creating user database!" );
        }

        $isTransactionDbCreated = file_put_contents( BASE_PATH . "/$folderName/transactions.txt", "[]" );
        if ( !$isTransactionDbCreated ) {
            throw new Exception( "Permission Denied when creating transaction database!" );
        }
        printf( "✅ Successfully Created Migrations\n" );
    }
}
