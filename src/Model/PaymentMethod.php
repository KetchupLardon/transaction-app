<?php

namespace App\Model;

class PaymentMethod extends Model
{

    public function findAll()
    {
        $req = $this->db->query("SELECT * FROM moyen_paiement");
        $response = $req->fetchAll();
        return $response;
    }

}