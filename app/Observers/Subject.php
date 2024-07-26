<?php
//AUTHOR: Kuai Cheng Keat 21WMR05137
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;

/**
 * Description of Subject
 *
 * @author Kuai Cheng Keat 21WMR05137
 */
abstract class Subject {
    private $observers;
    
    public function __construct(){
        $this->observers = array();
    }
    
    public function attach(Observer $observer){
        array_push($this->observers, $observer);
    }
    
    public function detach(Observer $observer){
        $index = 0;
        foreach ($this->observers as $o){
            if($o == $observer){
                array_splice($this->observers, $index);
            }
            $index++;
        }
    }
    
    public function notify(){
        foreach($this->observers as $o){
            $o->update($this);
        }
    }
}