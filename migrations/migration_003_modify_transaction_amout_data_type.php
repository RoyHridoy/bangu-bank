<?php

namespace App\migrations;

use App\Core\Database;

class migration_003_modify_transaction_amout_data_type
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function up()
    {
        $this->db->getPdo()->exec("ALTER TABLE transactions MODIFY amount FLOAT NOT NULL");
    }

    public function down()
    {
        $this->db->getPdo()->exec("ALTER TABLE transactions MODIFY amount INT NOT NULL");
    }
}
