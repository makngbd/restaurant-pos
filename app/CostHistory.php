<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostHistory extends Model
{
    protected $fillable = [
        'title', 'amount', 'date', 'cost_type', 'ref_id', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
