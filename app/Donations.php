<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $fillable = [
        'name',
        'pledge',
        'message',
        'user_id'
    ];
}
