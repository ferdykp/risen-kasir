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
        'shoes', // gunakan kolom JSON array
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

    protected $casts = [
        'shoes' => 'array', // konversi otomatis ke array saat diakses
        'order_start' => 'datetime',
        'estimated' => 'datetime',
        'order_finish' => 'datetime',
    ];
}
