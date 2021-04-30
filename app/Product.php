<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_description', 'product_code', 'product_price', 'product_discount', 'product_image', 'product_category', 'created_by', 'updated_by', 'publication_status', 'deletation_status', 'version_number'
    ];
}
