<?php
namespace App\Model;
use App\Model\Database;

abstract class Model {
    
    protected $db;

    public function __construct()
    {
        $this->db = Database::getPDO();
    }

};