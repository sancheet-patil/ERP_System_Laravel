<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionLists extends Model
{
    protected $table = 'division_lists';

    protected $fillable = [
        'division',
    ];
}
