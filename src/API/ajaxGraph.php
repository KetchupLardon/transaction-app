<?php

require_once realpath("../../vendor/autoload.php");
use \App\Model\Database;
use \App\Model\Transaction;

$db = Database::getPDO();
$instanciateTransaction = new Transaction;
$selectedMonth;
if(is_null($_POST['selectedMonth'])){
    $selectedMonth = "MONTH(CURRENT_DATE())"; 
} else {
    $selectedMonth = $_POST['selectedMonth'];
}
$monthDebit = $instanciateTransaction->getActualMonthDebit("debit", $selectedMonth);
$monthCredit = $instanciateTransaction->getActualMonthDebit("credit", $selectedMonth);

$output = "
<div id='type_stat_container'>
    <div id='type_stat_subcontainer'>
        <h3>Type de statistiques</h3>
        <div id='total_stat'>
            <div id='credit_amount' class='green'> $monthCredit €</div>
            <div id='debit_amount' class='red'> $monthDebit €</div>
        </div>
    </div>
</div>
"; 

echo $output;

