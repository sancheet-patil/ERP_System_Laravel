<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintsList extends Model
{
    protected $table = 'complaints_lists';

    protected $fillable = [
        'academicyear','complaintby','phone','complaintdate','description','assigned','actiontaken','complaintstatus',
    ];
}
