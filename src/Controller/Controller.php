<?php

namespace App\Controller;
use \App\Model\Transaction;

class Controller
{
    
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction;
    }

    public function getTransactionForEdit($transactionId)
    {
        $response = $this->transaction->getTransaction($transactionId);
        return $response;
    }

    public function sendTransactionForUpdate($transactionId)
    {
        if($transactionId && $_POST["category"] && $_POST["payment_method"] && $_POST["amount"] && $_POST["date"] && $_POST["type"]){
            $response = $this->transaction->updateTransaction($transactionId, $_POST["category"], $_POST["amount"], $_POST["type"], $_POST["date"], $_POST["comment"], $_POST["payment_method"]);
            return $response;
        }
    }
}