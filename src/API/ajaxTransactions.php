<?php

require_once realpath("../../vendor/autoload.php");
use \App\Model\Database;

$db = Database::getPDO();
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

$query = "SELECT  t.amount, t.type, t.date, t.comment, c.name, m.method 
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
$amount = [];
$category = [];
$comment = [];
$date = [];

function checkMinus($data, $number) 
{
    if(substr($data, 0, 1) == "-" && $number === true){
        return "red";
    } elseif ($number === true) {  
        return "green";
    }
}

function createDatasHTMLColumn($data, $number = false)
{
    $HTML = "";
    $HTML .= "<div class='flex_column'>";
    foreach ($data as $value){
        $HTML .= "<div class='" . checkMinus($value, $number) . "'>$value</div>";
    }
    $HTML .= "</div>";
     return $HTML;
}
function activePageCSS($page, $iteration)
{
    if($page == $iteration){
        return "active_pagination";
    }
    return;
}

if($total_data > 0){
    //store each column's data in variable
    foreach ($result as $transaction){
        foreach ($transaction as $key => $value){
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

    $output .= "<div class='transaction'>";
    
    $output .= createDatasHTMLColumn($category);
    $output .= createDatasHTMLColumn($comment);
    $output .= createDatasHTMLColumn($date);
    $output .= createDatasHTMLColumn($amount, true);

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
