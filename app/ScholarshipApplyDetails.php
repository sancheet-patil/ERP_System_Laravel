<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScholarshipApplyDetails extends Model
{
    protected $table = 'scholarship_apply_details';

    protected $fillable = [
        'academicyear','studentid','scholarship','scholarshipclass','scholarshipdivision','scholarshipfaculty','scholarshipamount',
        'noofmonths',
    ];
}
