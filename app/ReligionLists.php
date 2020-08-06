<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReligionLists extends Model
{
    protected $table = 'religion_lists';

    protected $fillable = [
        'religion',
    ];
}
