<?php

$errorLogin = false;

if(!empty($_POST)){
    $user = $auth->login($_POST["username"], $_POST["password"]);
    if($user){
        header("Location: index.php?home");
        exit();
    }
    $errorLogin = true;
}
ob_start();
?>

<h2>Salsifi Budget</h2>

<?php if($error): ?>
    <div>Nom d'utilisateur ou mot de passe incorrect</div>
<?php endif ?>

<form id="login_form" action="" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <button type="submit">Connexion</button>
</form>

<?php 
$content = ob_get_clean();
require_once("template.php");