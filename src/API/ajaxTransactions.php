<?php

require_once realpath("../../vendor/autoload.php");
use \App\Model\Database;
use App\Controller\Utils;

$db = Database::getPDO();
$instanceUtils = new Utils;
$output = ""; 
$WHEREisDefined = false;
$recordsPerPage = 5;
$page = "";

function whereOrAnd($WHEREisDefined)
{ 
    if($WHEREisDefined){
        return" AND ";
    } else {
        return" WHERE ";
    };
};

function activePageCSS($page, $iteration)
{
    if($page == $iteration){
        return "active_pagination";
    }
    return;
}

$query = "SELECT t.id, t.amount, t.type, t.date, t.comment, c.name, m.method 
FROM transaction t
LEFT JOIN categorie c ON t.categorie_id = c.id 
LEFT JOIN moyen_paiement m ON t.payment_method_id = m.id";

if(isset($_POST["category"]) && $_POST["category"] !== '' ){
    $query .=  whereOrAnd($WHEREisDefined) . "t.categorie_id = " . $_POST['category'];
    $WHEREisDefined = true;
}

if(isset($_POST["payment_method"]) && $_POST["payment_method"] !== ''){
    $query .=  whereOrAnd($WHEREisDefined) . "t.payment_method_id = " . $_POST['payment_method'];
    $WHEREisDefined = true;
}

if(isset($_POST["type"]) && $_POST["type"] !== ''){
    $query .=  whereOrAnd($WHEREisDefined) . "t.type = " . "'" . $_POST['type'] . "'";
    $WHEREisDefined = true;
}

if(isset($_POST["date"]) && $_POST["date"] !== ''){
    if($_POST["date"] === "jours"){
        $query .=  whereOrAnd($WHEREisDefined) . "t.date >= now() -INTERVAL 1 DAY ";
        $WHEREisDefined = true;
    } else if($_POST["date"] === "mois"){
        $query .=  whereOrAnd($WHEREisDefined) . "t.date >= now() -INTERVAL 30 DAY ";
        $WHEREisDefined = true;
    } else if($_POST["date"] === "années"){
        $query .=  whereOrAnd($WHEREisDefined) . "t.date >= now() -INTERVAL 1 YEAR ";
        $WHEREisDefined = true;
    }
}

if(isset($_POST["page"])){
    $page = $_POST["page"];
} else {
    $page = 1;
}
$startFrom = ($page - 1) * $recordsPerPage;

$query .= " ORDER BY t.date DESC";
//define the result per pages
$paginationQuery = $query . " LIMIT $startFrom, $recordsPerPage";
$statement = $db->query($query);
$total_data = $statement->rowCount();
$statement = $db->query($paginationQuery);
$result = $statement->fetchAll();

if($total_data > 0){
    //store each column's data in variable
    $sortedData = $instanceUtils->sortDatas($result);

    $output .= "<div class='transaction'>";
    
    $output .= $instanceUtils->createDatasHTMLColumn($sortedData['category']);
    $output .= $instanceUtils->createDatasHTMLColumn($sortedData['comment']);
    $output .= $instanceUtils->createDatasHTMLColumn($sortedData['date']);
    $output .= $instanceUtils->createDatasHTMLColumn($sortedData['amount'], true);
    $output .= $instanceUtils->createEditColumn($sortedData['id']);

    $output .= "</div>";
} else {
    $output .= "<p>Aucune trasactions trouvées</p>";
}

$total_pages = ceil($total_data/$recordsPerPage);


$output .= "<div class='pagination_link_container'>";
for($i = 1; $i <= $total_pages; $i++){
    $output .= "<span class='pagination_link " . activePageCSS($page, $i) . "'>$i</span>";
}

$output .= "</div>";

echo $output;
