<?php

require_once realpath("../../vendor/autoload.php");
use \App\Model\Database;
use \App\Model\Transaction;

$db = Database::getPDO();
$instanciateTransaction = new Transaction;
$selectedMonth = $_POST['selectedMonth'];
$selectedYear = $_POST['selectedYear'];
$monthDebit = $instanciateTransaction->getActualMonthDebit("debit", $selectedMonth, $selectedYear);
$monthDebit = is_null($monthDebit) ? 0 : $monthDebit;
$monthCredit = $instanciateTransaction->getActualMonthDebit("credit", $selectedMonth, $selectedYear);
$monthCredit = is_null($monthCredit) ? 0 : $monthCredit;

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