<?php 
use \App\Model\Category;
use \App\Model\PaymentMethod;
use \App\Controller\Transaction;


$categoryClass = new Category;
$categoriesArray = $categoryClass->findAll();
$paymentClass = new PaymentMethod;
$paymentArray = $paymentClass->findAll();
if(isset($_POST)){
    $transactionClass = new Transaction;
    $transactionClass->checkBefoteCreate($_SESSION["auth"]);
}

$title = "Salsifi Budget | Ajout Transaction";

ob_start();
?>

<h2>Ajouter une transaction</h2>

<form class="add_transaction" action="" method="POST">
    <div id="category_container">
        <label for="category">Catégorie :</label>
        <select name="category" id="category">
            <option value=""> </option>
            <?php foreach ($categoriesArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["name"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div id="payment">
        <label for="payment_method">Moyen de paiement :</label>
        <select name="payment_method" id="payment_method">
            <option value=""> </option>
            <?php foreach ($paymentArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["method"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div id="amount">
        <label for="amount">Montant :</label>
        <div>
            <input type="number" name="amount" id="amount">
            <span>€</span>
        </div>
    </div>
    <div id='date'>
        <label for="date">Date :</label>
        <input type="date" name="date" id="date">
    </div>
    <div id="transaction_type">
        <h3>Type de transaction :</h3>
        <div>
            <input type="radio" name="type" id="credit" value="credit">
            <label for="credit">Crédit</label>
            <input type="radio" name="type" id="debit" value="debit">
            <label for="debit">Débit</label>
        </div>
    </div>
    <div id="comment">
        <label for="comment">Commentaire :</label>
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
    </div>
    <button type="submit">Valider</button>
</form>


<?php 
$content = ob_get_clean();
require("template.php");
?>