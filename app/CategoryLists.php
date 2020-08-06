<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLists extends Model
{
    protected $table = 'category_lists';

    protected $fillable = [
        'category',
    ];
}
