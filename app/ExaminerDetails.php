<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminerDetails extends Model
{
    protected $table = 'examiner_details';

    protected $fillable = [
        'academicyear','staffid','registerfor',
    ];
}
