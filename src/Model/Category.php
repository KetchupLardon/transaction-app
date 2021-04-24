<?php

namespace App\Model;
use App\Model\Database;

class Category
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getPDO();
    }

    public function findAll()
    {
        $req = $this->db->query("SELECT id, name FROM categorie");
        $response = $req->fetchAll();
        return $response;
    }

}