<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name', 'company_address', 'company_email', 'company_phone', 'company_vat_reg_no', 'user_id', 'version_number'
    ];
}
