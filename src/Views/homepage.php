<?php 
use App\Model\Transaction;
$instanceTransaction = new Transaction;
$transactions = $instanceTransaction->getLastTransactions();
$monthDebit = $instanceTransaction->getActualMonthDebit('debit');
$monthCredit = $instanceTransaction->getActualMonthDebit('credit');
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

<h2>Accueil</h2>

<div>
    <div id="left_arrow"></div>
    <h3 id=js_mont_name></h3>
    <div></div>
</div>

<div id="graph">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>
<div>
    <h3>Type de statistiques</h3>
    <div class="flex_row">
        <div id="credit_amount" class="green"><?= $monthCredit?></div>
        <div id="debit_amount" class="red"><?= $monthDebit?></div>
    </div>
</div>
<div>
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