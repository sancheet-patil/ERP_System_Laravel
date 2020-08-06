<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HolidayLists extends Model
{
    protected $table = 'holiday_lists';

    protected $fillable = [
        'hdate','reason',
    ];
}
