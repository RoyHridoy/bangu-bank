<?php

use App\Core\CLIDb;
define( "BASE_PATH", __DIR__ );

require_once BASE_PATH . "/vendor/autoload.php";

$db = new CLIDb( "users" );
printf( "To create admin: \n  1. First Register as a Customer from website\n  2. Provide Email Address here:\n" );
$userEmail     = htmlspecialchars( readline( "email Address:" ) );
$validateEmail = filter_var( $userEmail, FILTER_VALIDATE_EMAIL );

$user = $db->findOrFail( "email", $validateEmail );

if ( !$user ) {
    printf( "❌ User Not Found. Register first\n" );
    return false;
}

$isAdminCreated = $db->createAdmin( $user );

if ( $isAdminCreated ) {
    printf( "✅ {$validateEmail} is now an admin. ✅\n" );
}
