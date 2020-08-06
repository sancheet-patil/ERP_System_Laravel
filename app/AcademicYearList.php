<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYearList extends Model
{
    protected $table = 'academic_year_lists';

    protected $fillable = [
        'academicyear',
    ];
}
