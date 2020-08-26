<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEducationalDetails extends Model
{
    protected $table = 'student_educational_details';

    protected $fillable = [
        'userid','academicyear','classname',
    ];
}
