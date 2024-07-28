<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * 
     * @author Leow Soon Kuan
     *
     */

    use HasFactory;
    
    protected $fillable = [
        'orderID', 'total', 'paymentDate', 'paymentMethod'
    ];
}
