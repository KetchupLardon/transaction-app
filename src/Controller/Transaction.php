<?php

namespace App\Controller;
use \App\Model\Transaction as TransactionModel;

class Transaction
{
    public function checkBefoteCreate($userId)
    {
        if($_POST["category"] && $_POST["payment_method"] && $_POST["amount"] && $_POST["date"] && $_POST["type"]){
            $transaction = new TransactionModel;
            $req = $transaction->createNew($userId, $_POST["category"], $_POST["amount"], $_POST["type"], $_POST["date"], $_POST["comment"], $_POST["payment_method"]);
            return $req;
        }
    }
}
