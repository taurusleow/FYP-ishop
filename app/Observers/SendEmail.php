<?php
//AUTHOR: Kuai Cheng Keat 21WMR05137
//Function work but email SSL error
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;

use App\Observers\Observer;
use App\Observers\PaymentData;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Member;

/**
 * Description of SendEmail
 *
 * @author e-default
 */
class SendEmail implements Observer {

    private $cartItem;
    private $cartProduct;
    private $voucher;
    private $cart;
    private $order;
    private $member;
    private $payment;

    function __construct(PaymentData $paymentData) {
        $this->cartItem = $paymentData->getCartItem();
        $this->cartProduct = $paymentData->getProduct();
        $this->cart = $paymentData->getCart();
        $this->order = $paymentData->getOrder();
        $this->member = $paymentData->getMember();
        $this->payment = $paymentData->getPayment();
    }

    public function update(Subject $subject) {
        $cartItem = $subject->getCartItem();
        $cartProduct = $subject->getProduct();
        $cart = Cart::find($subject->getCart());
        $getMember = Member::find($subject->getMember());
        $payment = $subject->getPayment();

        $details = [
            'title' => 'Thank you ' . $getMember->username . ' for choosing PohLai',
            'body' => 'Below is your purchasing details at ' . $payment->paymentDate . ': ',
            'cartItem' => $cartItem,
            'cartProduct' => $cartProduct,
            'payment' => $payment,
            'total' => $cart->subtotal
        ];

        \Mail::to($getMember->emailAddress)->send(new \App\Mail\MailFunction($details));
    }
}