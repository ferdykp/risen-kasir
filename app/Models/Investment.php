<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $table = 'investment';

    protected $fillable = [
        'name',
        'date_invest',
        'invest'
    ];
}
