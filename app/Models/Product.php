<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchantEmail',
        'category',
        'productName',
        'productDesc',
        'productPrice',
        'productStock',
        'productSold',
        'authentication',
        'status',
        'popularity',
    ];
}
