<?php

use \App\Controller\Controller;
$controllerClass = new Controller;
$selectedTransaction = $controllerClass->getTransactionForDelete(intval($_GET['delete']));
$_SESSION['delete'] = "success";
header("Location: index.php?transaction");
exit();
