<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = [
        'productID',
        'variantName1',
        'variantName2',
        'variantName3',
        'variantName4',
        'variantName5',
        'variantImg1',
        'variantImg2',
        'variantImg3',
        'variantImg4',
        'variantImg5',
    ];
}
