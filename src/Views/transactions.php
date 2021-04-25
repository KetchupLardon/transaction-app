<?php 

use \App\Controller\Controller;

$controllerClass = new Controller;
$categoriesArray = $controllerClass->getAllCategories();
$paymentArray = $controllerClass->getAllPaymentMethod();

$title = "Salsifi Budget | Transactions";

ob_start();
?>

<div id="filter_select" class="margin_top">
    <div>
        <label for="">Type :</label>
        <div>
            <label for="credit">
                <input type="radio" name="type" id="credit" value="credit" class="js_filter">Crédit
            </label>
            <label for="debit">
                <input type="radio" name="type" id="debit" value="debit" class="js_filter">Débit
            </label>
        </div>
    </div>
    <div>
        <label for="category">Catégorie :</label>
        <select name="category" id="category" class="js_filter">
            <option value=""> </option>
            <?php foreach ($categoriesArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["name"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div>
        <label for="payment_method">Moyen de paiement :</label>
        <select name="payment_method" id="payment_method" class="js_filter">
            <option value=""> </option>
            <?php foreach ($paymentArray as $value):?>
                <option value="<?= $value["id"]?>"><?= $value["method"]?></option>
            <?php endforeach?>
        </select>
    </div>
    <div>
        <label for="date">Date :</label>
        <select name="date" id="date" class="js_filter">
            <option value=""> </option>
            <option value="jours">Denière 24h</option>
            <option value="mois">Denier mois</option>
            <option value="année">Denière année</option>
        </select>
    </div>
</div>
<div id="js_filters" class="flex_row_buttons"></div>
<div id="transaction_list_container"></div>

<?php
$content = ob_get_clean();
require_once("template.php");
?>