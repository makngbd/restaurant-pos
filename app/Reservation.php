<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date',
        'date_format',
        'time',
        'guest',
        'name',
        'email',
        'phone',
    ];
}
