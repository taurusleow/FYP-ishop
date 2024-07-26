<?php
namespace App\Http\Controllers;

require_once 'orderDate.php';
require_once 'orderSuccessful.php';

class orderHistoryClassFacade {
    private $orderDate;   
    private $orderSuccessful;
  
    function __construct() {
        $this->orderDate = new orderDate();
        $this->orderSuccessful = new orderSuccessful();
    }
  
    public function getOrderDateAndOrderSuccessful($from, $to) { 
        $ordersDate = $this->orderDate->getOrderDateFor($from, $to);
        $orderSuccessful = $this->orderSuccessful->getOrderSuccesfulFor($from, $to); 
    }
}