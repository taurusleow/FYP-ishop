<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class orderSuccessful {

    function getOrderSuccesfulFor($from, $to) {
        $orderSuccessful = DB::select('SELECT * FROM orders WHERE created_at="' . $from . '" AND orderDate="' . $to . '" AND status="Delivered"');

        echo "<br>List of Successful order:";

        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>ID </th>";
        echo "<th>Address</th>";
        echo "<th>Total</th>";
        echo "<th>Status</th>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($orderSuccessful as $orders) {
            echo "<tr>";
            echo "<td>" . $orders->id . "</td>";
            echo "<td>" . $orders->address . "</td>";
            echo "<td>RM " . $orders->total . "</td>";
            echo "<td>" . $orders->status . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

}
