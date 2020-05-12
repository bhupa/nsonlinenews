<?php

namespace App\Model\Video;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table  ='video';
    protected $fillable =[
        'title',
        'url',
        'is_active',
        'image'
    ];
}
