<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantAuthentications extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchantID',
        'fileName',
        'status',
    ];
}
