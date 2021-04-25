<?php

namespace App\Controller;
use \App\Model\Transaction;
use \App\Model\Category;
use \App\Model\PaymentMethod;

class Controller
{
    
    protected $transaction;
    protected $category;
    protected $paymentMethod;

    public function __construct()
    {
        $this->transaction = new Transaction;
        $this->category = new Category;
        $this->paymentMethod = new PaymentMethod;
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
    
    public function getTransactionForDelete($transactionId)
    { 
        $response = $this->transaction->deleteTransaction($transactionId);
        return $response;
    }

    public function checkBeforeCreate($userId)
    {
        if($_POST["category"] && $_POST["payment_method"] && $_POST["amount"] && $_POST["date"] && $_POST["type"]){
            $_SESSION["create"] = 'success';
            $req = $this->transaction->createNew($userId, $_POST["category"], $_POST["amount"], $_POST["type"], $_POST["date"], $_POST["comment"], $_POST["payment_method"]);
            return $req;
        }
    }
    
    public function getFourLastTransactions()
    { 
        $response = $this->transaction->getLastTransactions();
        return $response;
    }
    
    public function getAllCategories()
    { 
        $response = $this->category->findAll();
        return $response;
    }
    
    public function getAllPaymentMethod()
    { 
        $response = $this->paymentMethod->findAll();
        return $response;
    }
}