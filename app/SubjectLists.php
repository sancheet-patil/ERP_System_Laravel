<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectLists extends Model
{
    protected $table = 'subject_lists';

    protected $fillable = [
        'subjectname','subjectcode','subjecttype',
    ];
}
