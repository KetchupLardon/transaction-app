<?php

require_once realpath("vendor/autoload.php");

use \App\Controller\Rooter;

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

Rooter::runRooter();
