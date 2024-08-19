<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private const OPTIONS = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    private static $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        ENVReader::load();
        $dsn = "$_ENV[DB_TYPE]:host=$_ENV[DB_HOST];port=$_ENV[DB_PORT];dbname=$_ENV[DB_NAME];charset=$_ENV[DB_CHARSET]";
        try {
            $this->pdo = new PDO( $dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], self::OPTIONS );
        } catch ( PDOException $e ) {
            throw new PDOException( $e->getMessage(), (int) $e->getCode() );
        }
    }

    public static function getInstance(): self
    {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }
}
