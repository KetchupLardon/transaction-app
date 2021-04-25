<?php 
use \App\Controller\Controller;

$controllerClass = new Controller;
$categoriesArray = $controllerClass->getAllCategories();
$paymentArray = $controllerClass->getAllPaymentMethod();
if(isset($_POST)){
    $controllerClass->checkBeforeCreate($_SESSION["auth"]);
}

$title = "Salsifi Budget | Ajout Transaction";

ob_start();
?>

<h2>Ajouter une transaction</h2>

<form class="add_transaction" id="add_form" action="" method="POST">
    <div id="category_container">
        <label for="category" class="category_label">Catégorie : <span class="red">*</span></label>
        <select name="category" id="category">
            <option value=""> </option>
            <?php foreach ($categoriesArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["name"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div id="payment">
        <label for="payment_method" class="payment_method_label">Moyen de paiement : <span class="red">*</span></label>
        <select name="payment_method" id="payment_method">
            <option value=""> </option>
            <?php foreach ($paymentArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["method"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div id="amount_container">
        <label for="amount" class="amount_label">Montant : <span class="red">*</span></label>
        <div>
            <input type="number" name="amount" id="amount">
            <span>€</span>
        </div>
    </div>
    <div id='date_container'>
        <label for="date" class="date_label">Date : <span class="red">*</span></label>
        <input type="date" name="date" id="date">
    </div>
    <div id="transaction_type">
        <h3 class="type_label">Type de transaction : <span class="red">*</span></h3>
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