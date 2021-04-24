<?php

namespace App\Controller;

class Utils
{
    
    protected $amount = [];
    protected $category = [];
    protected $comment = [];
    protected $date = [];

    function checkMinus($value, $number) 
    {
        if(substr($value, 0, 1) == "-" && $number === true){
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

    function sortDatas(){
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
    }
}