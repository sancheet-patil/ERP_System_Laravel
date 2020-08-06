<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherSchoolLists extends Model
{
    protected $table = 'other_school_lists';

    protected $fillable = [
        'schoolname',
    ];
}
