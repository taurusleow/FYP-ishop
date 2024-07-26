<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;
use App\Observers\Observer;
use App\Observers\PaymentData;
use App\Models\Cart;

/**
 * Description of CartUpdate
 *
 * 
 */
class CartUpdate implements Observer {
    private $cart;
    
    public function __construct(PaymentData $paymentData) {
        $this->cart = $paymentData->getCart();
    }
    
    public function update(Subject $subject){
        $updateCart = Cart::find($subject->getCart());
        $updateCart->status = 'Paid';
        $updateCart->save();
    }
}
