<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;

use App\Observers\Observer;
use App\Observers\PaymentData;
use App\Models\OrderDetails;
use App\Models\Product;

/**
 * Description of ProductUpdate
 *
 * 
 */

class ProductUpdate implements Observer {

    private $cartItem;
    private $product;

    public function __construct(PaymentData $paymentData) {
        $this->product = $paymentData->getProduct();
        $this->cartItem = $paymentData->getCartItem();
    }

    public function update(Subject $subject) {
        $cartItem = $subject->getCartItem();
        $latest = $subject->getOrder()->id;
        
        foreach ($cartItem as $c) {
            $orderDetails = new OrderDetails();
            $getProduct = Product::find($c->productID);
            $orderDetails->orderID = $latest;
            $orderDetails->productID = $c->productID;
            $orderDetails->quantity = $c->quantity;
            $orderDetails->save();

            $getProduct->stock -= $c->quantity;
            $getProduct->quantitySold += $c->quantity;
            $getProduct->save();
        }
    }
}