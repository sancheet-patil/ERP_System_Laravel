<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationLists extends Model
{
    protected $table = 'designation_lists';

    protected $fillable = [
        'designation',
    ];
}
