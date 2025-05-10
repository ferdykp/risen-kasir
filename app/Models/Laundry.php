<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $table = 'data_laundry';

    protected $fillable = [
        'order_id',
        'customer_name',
        'phone_number',
        'shoe_merch',
        'shoe_color',
        'service',
        'price',
        'note',
        'payment_method',
        'payment_status',
        'working_status',
        'order_start',
        'estimated',
        'order_finish',
        'address'
    ];
}