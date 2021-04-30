<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_number', 'user_id', 'subtotal', 'discount_type', 'discount', 'extra_discount', 'discount_reference', 'vat', 'service_charge', 'grand_total', 'receive_amount', 'return_amount', 'version_number', 'date'
    ];
}
