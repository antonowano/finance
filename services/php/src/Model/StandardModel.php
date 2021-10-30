<?php

namespace App\Model;

use App\Database;
use App\Exception\ModelException;

class StandardModel
{
    private Database $db;

    /**
     * @throws ModelException
     */
    public function getDb(): Database
    {
        if (!isset($this->db)) {
            $this->db = new Database();
        }

        return $this->db;
    }
}
