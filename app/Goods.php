<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'good',
        'quantity',
        'district',
        'user_id'
    ];
}
