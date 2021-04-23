<?php

namespace App\Model;
use \App\Model\Database;

class PaymentMethod
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getPDO();
    }

    public function findAll()
    {
        $req = $this->db->query("SELECT * FROM moyen_paiement");
        $response = $req->fetchAll();
        return $response;
    }

}