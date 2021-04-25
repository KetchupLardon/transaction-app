<?php 
use \App\Model\Category;
use \App\Model\PaymentMethod;
use \App\Controller\Transaction;
use \App\Controller\Controller;


$categoryClass = new Category;
$controllerClass = new Controller;
$paymentClass = new PaymentMethod;
$selectedTransaction = $controllerClass->getTransactionForEdit(intval($_GET['edit']));
$categoriesArray = $categoryClass->findAll();
$paymentArray = $paymentClass->findAll();
if(!empty($_POST)){
    $controllerClass->sendTransactionForUpdate(intval($_GET['edit']));
    $_SESSION["edit"] = 'success';
    header("Location: index.php?transaction");
    exit();
}

$title = "Salsifi Budget | Éditer Transaction";

ob_start();
?>

<h2>Éditer une transaction</h2>

<form class="add_transaction" class="form" id="edit_form" action="" method="POST">
    <div id="category_container">
        <label for="category" class="category_label">Catégorie : <span class="red">*</span></label>
        <select name="category" id="category">
            <option value="<?= $selectedTransaction['categorie_id'] ?>"><?= $selectedTransaction['name'] ?></option>
            <?php foreach ($categoriesArray as $value):?>
                <?php if($selectedTransaction['name'] !== $value["name"] ): ?>
                    <option value="<?= $value["id"]?>"><?= $value["name"]?></option>
                <?php endif ?>
            <?php endforeach?>
        </select>
    </div>
    <div id="payment">
        <label for="payment_method" class="payment_method_label">Moyen de paiement : <span class="red">*</span></label>
        <select name="payment_method" id="payment_method">
            <option  value="<?= $selectedTransaction['payment_method_id'] ?>"><?= $selectedTransaction['method'] ?></option>
            <?php foreach ($paymentArray as $value):?>
                <?php if($selectedTransaction['method'] !== $value["method"] ): ?>
                    <option value="<?= $value["id"]?>"><?= $value["method"]?></option>
                <?php endif ?>
            <?php endforeach?>
        </select>
    </div>
    <div id="amount_container">
        <label for="amount" class="amount_label">Montant : <span class="red">*</span></label>
        <div>
            <input type="number" name="amount" id="amount" value="<?= $selectedTransaction['amount'] ?>">
            <span>€</span>
        </div>
    </div>
    <div id='date_container'>
        <label for="date" class="date_label">Date : <span class="red">*</span></label>
        <input type="date" name="date" id="date" value="<?= $selectedTransaction['date'] ?>">
    </div>
    <div id="transaction_type">
        <h3 class="type_label">Type de transaction : <span class="red">*</span></h3>
        <div>
            <input type="radio" name="type" id="credit" value="credit" <?= $selectedTransaction['type'] === 'debit' ? 'checked' : '' ?>>
            <label for="credit">Crédit</label>
            <input type="radio" name="type" id="debit" value="debit" <?= $selectedTransaction['type'] === 'credit' ? 'checked' : '' ?>>
            <label for="debit">Débit</label>
        </div>
    </div>
    <div id="comment">
        <label for="comment">Commentaire :</label>
        <textarea name="comment" id="comment" cols="30" rows="10"><?= $selectedTransaction['comment'] ?></textarea>
    </div>
    <button type="submit">Valider</button>
</form>


<?php 
$content = ob_get_clean();
require("template.php");
?>