<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorBookDetails extends Model
{
    protected $table = 'visitor_book_details';

    protected $fillable = [
        'academicyear','visitpurpose','visitorname','visitorphone','visitoridcard','visitoridcardnumber','visitdate','intime','outtime',
    ];
}
