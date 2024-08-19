<?php

namespace App\Core\Migrations;

use App\Core\Database;
use PDO;

class MysqlMigration
{
    private $pdo;

    public function __construct()
    {
        try {
            $db        = Database::getInstance();
            $this->pdo = $db->getPdo();
            $this->applyMigrations();
        } catch ( \Throwable $e ) {
            $this->showMessage( $e->getMessage(), "⛔" );
        }
    }

    private function applyMigrations()
    {
        $this->createMigrationTable();
        $migrationsToApply = $this->migrationsToApply();

        if ( !$migrationsToApply ) {
            $this->showMessage( "Noting to Migrate", "✅" );
            return;
        }

        foreach ( $migrationsToApply as $migration ) {
            require_once BASE_PATH . "/migrations/$migration";
            $className = pathinfo( $migration, PATHINFO_FILENAME );
            $instance  = new ( "App\Migrations\\$className" );
            $this->showMessage( "Applying Migration - {$migration}", "🔃" );
            $instance->up();
            $this->pdo->query( "INSERT INTO migrations( migration ) VALUES ('$migration');" );
            $this->showMessage( "Applied Migration - {$migration}", "✅" );
        }
    }

    private function createMigrationTable(): void
    {
        $this->pdo->query( "CREATE TABLE IF NOT EXISTS migrations(
            id INT NOT NULL AUTO_INCREMENT,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );" );
    }

    private function migrationsToApply(): array | bool
    {
        $path             = BASE_PATH . "/migrations";
        $files            = array_diff( scandir( $path ), [".", ".."] );
        $migrationToApply = array_diff( $files, $this->getAppliedMigrations() );
        if ( !$migrationToApply ) {
            return false;
        }
        return $migrationToApply;
    }

    private function getAppliedMigrations(): array
    {
        $stmt = $this->pdo->prepare( "SELECT migration FROM migrations" );
        $stmt->execute();
        return $stmt->fetchAll( PDO::FETCH_COLUMN );
    }

    private function showMessage( string $message, string $icon = "" )
    {
        printf( "%s %s\n", $icon, $message );
    }
}
