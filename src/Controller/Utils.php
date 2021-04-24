<?php

namespace App\Controller;

class Utils
{
    
    protected $amount = [];
    protected $category = [];
    protected $comment = [];
    protected $date = [];

    protected function checkMinus($value, $number) 
    {
        if(substr($value, 0, 1) == "-" && $number === true){
            return "red";
        } elseif ($number === true) {  
            return "green";
        }
    }
    
    public function createDatasHTMLColumn($data, $number = false)
    {
        $HTML = "";
        $HTML .= "<div class='flex_column'>";
        foreach ($data as $value){
            $HTML .= "<div class='" . $this->checkMinus($value, $number) . "'>$value</div>";
        }
        $HTML .= "</div>";
        return $HTML;
    }

    public function sortDatas($result){
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
        return [
            'category' => $category,
            'amount' => $amount,
            'date' => $date,
            'comment' => $comment
        ];
    }
}