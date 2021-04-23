<?php

namespace App\Controller;
use \App\Model\User;

class Rooter
{
    public static function runRooter()
    {
        $auth = new User;

        if($auth->isConnected()){
            if(isset($_GET["transaction"])){
                require_once("src/Views/transactions.php");
            } elseif(isset($_GET["add-transaction"])){
                require_once("src/Views/addTransaction.php");
            } elseif(isset($_GET["connexion"])){
                require_once("src/Views/connexion.php");
            } else {
                require_once("src/Views/homepage.php");
            }
        } else {
            require_once("src/Views/connexion.php");
        }
    }
}