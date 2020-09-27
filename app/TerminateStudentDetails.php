<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminateStudentDetails extends Model
{
    protected $table = 'terminate_student_details';

    protected $fillable = [
        'userid','dateofterminate','remarks',
    ];
}
