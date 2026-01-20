<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price',
        'rating',
        'stock_quantity',
        'description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
