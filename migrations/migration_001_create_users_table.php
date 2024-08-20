<?php

namespace App\migrations;

use App\Core\Database;

class migration_001_create_users_table
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function up()
    {
        $this->db->getPdo()->exec( "CREATE TABLE IF NOT EXISTS users (
            id INT NOT NULL AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            role VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at INT NOT NULL DEFAULT (UNIX_TIMESTAMP()),
            PRIMARY KEY (id)
        );" );
    }

    public function down()
    {
        $this->db->getPdo()->exec( "DROP TABLE users" );
    }
}
