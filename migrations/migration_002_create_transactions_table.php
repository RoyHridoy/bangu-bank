<?php

namespace App\migrations;

use App\Core\Database;

class migration_002_create_transactions_table
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function up()
    {
        $this->db->getPdo()->exec( "CREATE TABLE IF NOT EXISTS transactions(
            id INT NOT NULL AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL,
            amount INT NOT NULL,
            type VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL,
            created_at INT NOT NULL DEFAULT (UNIX_TIMESTAMP()),
            user_id INT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id),
            primary key (id)
        );" );
    }

    public function down()
    {
        $this->db->getPdo()->exec( "DROP TABLE IF EXISTS transactions" );
    }
}
