<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'parent_category', 'publication_status', 'created_by', 'updated_by', 'deletation_status', 'version_number'
    ];
}
