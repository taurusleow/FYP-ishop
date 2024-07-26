<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Observers;

/**
 * Description of Observer
 *
 *
 */
interface Observer {
    public function update(Subject $subject);
}
