<?php

namespace App\SecurityClass;

/**
 * Description of ValidateCardPayment
 *
 * 
 */
class ValidateCardPayment {
    private $card;
    private $cvv;
    
    function __construct($card, $cvv) {
        $this->card = $card;
        $this->cvv = $cvv;
    }

    function checkInput(){
        $message = "";
        
        if(!preg_match("/^[0-9]{16}$/", $this->card)){
            $message .= "Credit card number should be 16 digits!|";
        }
        if(!preg_match("/^[0-9]{3}$/", $this->cvv)){
            $message .= "CVV should be 3 digits!|";
        }
        return $message;
    }
}