<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'user_id', 'version_number'
    ];
}
