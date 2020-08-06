<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamTypeList extends Model
{
    protected $table = 'exam_type_lists';

    protected $fillable = [
        'examtype',
    ];
}
