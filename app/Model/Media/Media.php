<?php

namespace App\Model\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable =[
        'image',
        'gallery_id'
    ];
}
