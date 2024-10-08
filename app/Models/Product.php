<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'categories',
        'sku',
        'price',
        'stock_quantity',
        'size',
        'weight',
        'description',
        'images'
    ];

    // Convert categories and images to array automatically
    protected $casts = [
        'categories' => 'array',
        'images' => 'array',
    ];
}