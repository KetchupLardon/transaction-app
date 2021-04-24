<?php
namespace App\Model;
use \PDO;

class Database {

    public static function getPDO(): PDO {

        $db = new PDO('mysql:host=localhost;dbname=transapp;charset=utf8', 'toto', 'toto', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $db;

    }

};