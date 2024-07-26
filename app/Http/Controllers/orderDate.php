<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Description of orderDate
 *
 * @author Leow Soon Kuan
 */
class orderDate {

    function getOrderDateFor($from, $to) {
        echo "<br />The order date you wanted: <br />";

        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>From: " . $from . "</th>";
        echo "<th>To: " . $to . "</th>";
        echo "</thead>";
        echo "</table>";
    }

}
