<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonafideDetails extends Model
{
    protected $table = 'bonafide_details';

    protected $fillable = [
        'academicyear','studentid','issuedate','printcount',
    ];
}
