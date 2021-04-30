<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageItem extends Model
{
    protected $fillable = [
        'item_id', 'item_name', 'quantity', 'damage_from', 'history_id', 'remark', 'date', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
