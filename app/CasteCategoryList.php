<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasteCategoryList extends Model
{
    protected $table = 'caste_category_lists';

    protected $fillable = [
        'religion','category','castename','subcaste',
    ];
}
