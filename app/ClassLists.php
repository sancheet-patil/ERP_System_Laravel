<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassLists extends Model
{
    protected $table = 'class_lists';

    protected $fillable = [
        'classname','division',
    ];
}
