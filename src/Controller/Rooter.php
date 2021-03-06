<?php

namespace App\Controller;
use \App\Model\User;

class Rooter
{
    public static function runRooter()
    {
        $auth = new User;
        $userData = $auth->isConnected();

        if($userData){
            if(isset($_GET["transaction"])){
                require_once("src/Views/transactions.php");
            } elseif(isset($_GET["add-transaction"])){
                require_once("src/Views/addTransaction.php");
            } elseif(isset($_GET["connexion"])){
                require_once("src/Views/connexion.php");
            } elseif(isset($_GET["edit"])){
                require_once("src/Views/editTransaction.php");
            }  elseif(isset($_GET["delete"])){
                require_once("src/Views/deleteTransaction.php");
            } else {
                require_once("src/Views/homepage.php");
            }
        } else {
            require_once("src/Views/connexion.php");
        }
    }
}