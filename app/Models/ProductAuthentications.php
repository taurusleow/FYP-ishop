<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAuthentications extends Model
{
    use HasFactory;

    protected $fillable = [
        'productID',
        'fileName',
        'status',
    ];
}
