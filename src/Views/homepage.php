<?php 
use App\Controller\Controller;
use App\Controller\Utils;
$controllerClass = new Controller;
$instanceUtils = new Utils;
$transactions = $controllerClass->getFourLastTransactions();
$sortedData = $instanceUtils->sortDatas($transactions);
$title = "Salsifi Budget | Accueil";
ob_start();
?>

<div id="month_select">
    <div id="left_arrow"></div>
    <h3 id=js_month_name></h3>
    <div id="right_arrow"></div>
</div>

<div id="graph_container">
    <div id="graph_subcontainer">
        <canvas id="myChart" width="100" height="100"></canvas>
    </div>
</div>

<div id="js_amount_display"></div>

<div id="transaction_home_container">
    <h3>Dernières transactions</h3>
    <div class="transaction">
        <?= $instanceUtils->createDatasHTMLColumn($sortedData['category']) ?>
        <?= $instanceUtils->createDatasHTMLColumn($sortedData['comment']) ?>
        <?= $instanceUtils->createDatasHTMLColumn($sortedData['date']) ?>
        <?= $instanceUtils->createDatasHTMLColumn($sortedData['amount'], true) ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
require_once("template.php");
?>