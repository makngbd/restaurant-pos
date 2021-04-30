<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'discount_type', 'discount', 'discount_deadline', 'vat', 'service_charge', 'user_id', 'version_number'
    ];
}
