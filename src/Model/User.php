<?php

namespace App\Model;
use \App\Controller\User as UserController;
use \PDO;

class User extends Model
{

    public function isConnected()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $id = $_SESSION['auth'];

        if($id === null){
            return null;
        }

        $req = $this->db->prepare("SELECT first_name, last_name FROM user WHERE id = ?");
        $req->execute([$id]);
        $response = $req->fetchObject(UserController::class);
        return $response;
    }

    public function login(string $username, string $password)
    {
        $req = $this->db->prepare("SELECT * FROM user WHERE name = :username AND password = :password");
        $req->execute(["username" => $username, "password" => $password]);
        $response = $req->fetchObject(UserController::class);
        if($response === false){
            return null;
        }
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['auth'] = $response->id;
        return $response;
    }
}
