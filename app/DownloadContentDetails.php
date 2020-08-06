<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadContentDetails extends Model
{
    protected $table = 'download_content_details';

    protected $fillable = [
        'academicyear','contenttitle','contenttype','availablefor','classname','division','description','contentpath',
    ];
}
