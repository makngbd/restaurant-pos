<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'invoice_number', 'product_id', 'product_code', 'product_name', 'quantity', 'product_price', 'discount_type', 'discount', 'amount', 'user_id', 'date', 'version_number'
    ];
}
