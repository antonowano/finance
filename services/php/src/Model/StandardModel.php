<?php

namespace App\Model;

use App\Database;

class StandardModel
{
    private Database $db;

    public function getDb(): Database
    {
        if (!isset($this->db)) {
            $this->db = new Database();
        }

        return $this->db;
    }
}
