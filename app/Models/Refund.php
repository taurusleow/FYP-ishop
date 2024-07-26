<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'orderID', 'damageProdImg', 'reason', 'updated_at', 'created_at'
    ];
}
