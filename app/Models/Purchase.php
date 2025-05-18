<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    protected $fillable = [
        'object_name',
        'quantity',
        'unit',
        'price',
        'total_price',
        'purchase_date',
        'pict_nota'
    ];

    protected $casts = [
        'purchase_date' => 'datetime'
    ];
}
