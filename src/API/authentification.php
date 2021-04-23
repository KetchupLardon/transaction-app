<?php

namespace App\API;
use \App\Model\User;

$auth = new User;
$user = $auth->login($_POST["username"], $_POST["password"]);
echo $user;