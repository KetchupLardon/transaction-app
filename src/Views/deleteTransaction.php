<?php

use \App\Controller\Controller;
$controllerClass = new Controller;
$selectedTransaction = $controllerClass->getTransactionForDelete(intval($_GET['delete']));
header("Location: index.php?home");
exit();
