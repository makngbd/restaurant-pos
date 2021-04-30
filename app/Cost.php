<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'supplier', 'particular', 'amount', 'date', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
