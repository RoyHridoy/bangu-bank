<?php

namespace App\Core;

use Exception;

class ExecuteCLICommand
{
    private static $instance     = null;
    private string $commandsPath = "commands";
    private array $validCommands = ["serve", "createAdmin", "migrate", "seed", "-h"];

    private function __construct( string $command )
    {
        $isValidCommand = $this->checkValidity( $command );
        if ( $isValidCommand ) {
            $this->execute( $command );
        }
    }

    public static function run( string $command )
    {
        if ( self::$instance === null ) {
            self::$instance = new self( $command );
        }
        return self::$instance;
    }

    private function checkValidity( string $command )
    {
        if ( !in_array( $command, $this->validCommands ) ) {
            throw new Exception( "Wrong Command.\nphp bangu -h to show available commands\n" );
        }
        return true;
    }

    private function execute( string $command )
    {
        switch ( $command ) {
            case 'serve':
                $this->serve();
                break;

            case 'seed':
                $this->seed();
                break;

            case 'migrate':
                $this->migrate();
                break;

            case 'createAdmin':
                $this->createAdmin();
                break;
            default:
                $this->help();
                break;
        }
    }

    private function serve()
    {
        ENVReader::load();
        $port = 8080;

        $doesCreateServer = shell_exec( "php -S {$_ENV['DB_HOST']}:{$port} public/index.php" );
        while ( $doesCreateServer === null ) {
            ++$port;
            $doesCreateServer = shell_exec( "php -S {$_ENV['DB_HOST']}:{$port} public/index.php" );
        }
    }

    private function seed()
    {
        include "{$this->commandsPath}/seed.php";
    }

    private function migrate()
    {
        include "{$this->commandsPath}/migrate.php";
    }

    private function createAdmin()
    {
        include "{$this->commandsPath}/createAdmin.php";
    }

    private function help()
    {
        foreach ( $this->validCommands as $command ) {
            printf( "php bangu %s\n", $command );
        }
    }
}
