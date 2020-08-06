<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form17LcDetails extends Model
{
    protected $table = 'form17_lc_details';

    protected $fillable = [
        'academicyear','issuedate','studentid','dateofpassing','examseatno','printcount',
    ];
}
