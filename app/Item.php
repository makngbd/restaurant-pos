<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name', 'unit', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
