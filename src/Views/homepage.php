<?php 
use App\Model\Transaction;
$instanceTransaction = new Transaction;
$transactions = $instanceTransaction->getLastTransactions();
$monthDebit = $instanceTransaction->getActualMonthDebit('debit');
$monthCredit = $instanceTransaction->getActualMonthDebit('credit');
$title = "Salsifi Budget | Accueil";
$amount = [];
$category = [];
$comment = [];
$date = [];
function createDatasHTMLColumn($data)
{
    $HTML = "";
    $HTML .= "
    <div class='flex_column'>
    ";
    foreach ($data as $value){
        $HTML .= "
        <div>$value</div>
        ";
    }
    $HTML .= "
    </div>
    ";
    
    return $HTML;
}
foreach ($transactions as $transaction){
    foreach ($transaction as  $key =>$value){
        if($key === "name") $category[] = $value;
        if($key === "amount") $amount[] = $value . " €";
        if($key === "date") $date[] = $value;
        if($key === "comment"){
            if($value){
                $comment[] = $value;
            } else {
                $comment[] = "<i>aucun commentaire</i>";
            }
        }
     }
}
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

<div id="homeDisplay"></div>

<div id="transaction_home_container">
    <h3>Dernières transactions</h3>
    <div class="transaction">
        <?=createDatasHTMLColumn($category)?>
        <?=createDatasHTMLColumn($comment)?>
        <?=createDatasHTMLColumn($date)?>
        <?=createDatasHTMLColumn($amount)?>
    </div>
</div>

<?php 
$content = ob_get_clean();
require_once("template.php");
?>