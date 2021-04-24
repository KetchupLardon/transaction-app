<?php

namespace App\Model;
use \App\Model\Database;

class Transaction
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getPDO();
    }

    public function getActualMonthDebit($type, $selectedMonth, $selectedYear)
    {
        $req = $this->db->prepare(
            "SELECT SUM(amount) FROM transaction WHERE EXTRACT(MONTH FROM date) =  :selectedMonth AND EXTRACT(YEAR FROM date) =  :selectedYear AND type = :type"
            );
        $req->execute([ "type" => $type, "selectedMonth" => $selectedMonth, "selectedYear" => $selectedYear]);
        $response = $req->fetchAll();
        return $response[0]['SUM(amount)'];
    }

    public function getLastTransactions()
    {
        $req = $this->db->query(
            "SELECT  t.amount, t.type, t.date, t.comment, c.name, m.method 
            FROM transaction t 
            LEFT JOIN categorie c ON t.categorie_id = c.id 
            LEFT JOIN moyen_paiement m ON t.payment_method_id = m.id
            ORDER BY date DESC
            LIMIT 4"
            );
        $response = $req->fetchAll();
        return $response;
    }

    public function createNew($userId, $categorieId, $amount, $type, $date, $comment, $paymentMethod)
    {
        $amount = $type === "debit" ? -$amount : $amount;
        $req = $this->db->prepare("INSERT INTO transaction (user_id, categorie_id, amount, type, date, comment, payment_method_id) VALUES (:user_id, :categorie_id, :amount, :type, :date, :comment, :payment_method_id);");
        $req->execute(["user_id" => $userId, "categorie_id" => $categorieId, "amount" => $amount, "type" => $type, "date" => $date, "comment" => $comment, "payment_method_id" => $paymentMethod]);
        return $req;
    }
}
