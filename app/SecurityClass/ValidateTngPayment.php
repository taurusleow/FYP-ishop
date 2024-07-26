<?php

namespace App\SecurityClass;

/**
 * Description of ValidateTngPayment
 *
 * 
 */
class ValidateTngPayment {
    private $phoneNo;
    private $pin;
    
    function __construct($phoneNo, $pin) {
        $this->phoneNo = $phoneNo;
        $this->pin = $pin;
    }

    function checkInput(){
        $message = "";
        
        if(!preg_match("/^[0-9]{10,11}$/", $this->phoneNo)){
            $message .= "Phone number should be 10-11 digits!|";
        }
        if(!preg_match("/^[0-9]{6}$/", $this->pin)){
            $message .= "PIN number should be 6 digits ONLY!|";
        }
        return $message;
    }
}
