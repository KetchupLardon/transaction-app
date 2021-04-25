<?php
if($userData){
    $extractedUserData = get_object_vars($userData);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css/middle-style.css">
    <link rel="stylesheet" media="screen and (max-width: 500px)" href="css/small-style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>
    <title><?= $title?></title>
</head>
<body>
    <?php if(isset($_SESSION['delete'])): ?>
        <?php if($_SESSION['delete'] === "success"): ?>
            <div class="success_banner">Transaction supprimé avec succès</div>
        <?php 
        unset($_SESSION['delete']);
        endif 
        ?>
    <?php endif ?>
    <?php if(isset($_SESSION["auth"])): ?>
        <header>
            <h1>Salsifi Budget</h1>
            <p><?= $extractedUserData['first_name'] ?> <?= $extractedUserData['last_name'] ?></p>
        </header>
        <nav>
            <div>
                <a class="<?= $title === "Salsifi Budget | Accueil" ? "active_navbar" : "" ?>" href="index.php">Accueil</a>
                <a class="<?= $title === "Salsifi Budget | Transactions" ? "active_navbar" : "" ?>" href="index.php?transaction">Transactions</a>
                <a class="<?= $title === "Salsifi Budget | Ajout Transaction" ? "active_navbar" : "" ?>" href="index.php?add-transaction">Ajouter</a>
            </div>
        </nav>
    <?php endif ?>