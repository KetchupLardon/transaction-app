<?php

namespace App\Model;

class Category extends Model
{

    public function findAll()
    {
        $req = $this->db->query("SELECT id, name FROM categorie");
        $response = $req->fetchAll();
        return $response;
    }

}