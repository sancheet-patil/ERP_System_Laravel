<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScholarshipLists extends Model
{
    protected $table = 'scholarship_lists';

    protected $fillable = [
        'scholarshipname',
    ];
}
