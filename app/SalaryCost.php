<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryCost extends Model
{
    protected $fillable = [
        'employee_name', 'month', 'amount', 'remark', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
