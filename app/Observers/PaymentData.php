<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;
use App\Observers\Subject;

/**
 * Description of CartData
 *
 * @author e-default
 */
class PaymentData extends Subject{
    private $member;
    private $cart;
    private $cartItem;
    private $product;
    
    private $payment;
    private $order;
    private $voucher;
    
    function __construct($member, $cart, $cartItem, $product) {
        parent::__construct();
        $this->member = $member;
        $this->cart = $cart;
        $this->cartItem = $cartItem;
        $this->product = $product;
    }
    
    function getMember() {
        return $this->member;
    }

    function getCart() {
        return $this->cart;
    }

    function getCartItem() {
        return $this->cartItem;
    }

    function getProduct() {
        return $this->product;
    }
    
    function getOrder() {
        return $this->order;
    }
    
    function getPayment() {
        return $this->payment;
    }
    
    function getVoucher() {
        return $this->voucher;
    }

    function setMember($member): void {
        $this->member = $member;
    }

    function setCart($cart): void {
        $this->cart = $cart;
    }

    function setCartItem($cartItem): void {
        $this->cartItem = $cartItem;
    }

    function setProduct($product): void {
        $this->product = $product;
    }
    
    function setPaymentDetails($payment, $order, $voucher): void{
        $this->payment = $payment;
        $this->order = $order;
        $this->voucher = $voucher;
        $this->notify();
    }
}