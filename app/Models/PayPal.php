<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
    /**
     * 
     * @author Leow Soon Kuan
     *
     */

    use HasFactory;

    protected $fillable = [
        'payment_id', 'payer_id', 'payer_email', 'amount', 'currency', 'payment_status', 'updated_at', 'created_at'
    ];
}
