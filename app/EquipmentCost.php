<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentCost extends Model
{
    protected $fillable = [
        'equipment_name', 'description', 'amount', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
