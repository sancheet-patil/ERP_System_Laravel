<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTimeTableDetails extends Model
{
    protected $table = 'class_time_table_details';

    protected $fillable = [
        'academicyear','classname','division','subjectname','dayofweek','starttime','endtime','hallno',
    ];
}
