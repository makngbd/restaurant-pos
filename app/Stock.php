<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'item_id', 'item_name', 'quantity', 'total_price', 'remark', 'date', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
