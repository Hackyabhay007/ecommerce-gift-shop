<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'email',
        'address',
        'state',
        'city',
        'pincode',
        'country',
        'phone_number',
        'price',
        'payment_type',
        'coupon_used',
    ];

    // Make sure the table name is correct
    protected $table = 'orders';
}