<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerEmail',
        'addressName',
        'addressNo',
        'addressOne',
        'addressTwo',
        'addressThree',
        'poscode',
        'country',
        'state',
    ];
}
