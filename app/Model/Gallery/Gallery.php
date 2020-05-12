<?php

namespace App\Model\Gallery;

use App\Model\Media\Media;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
     protected $fillable = [
         'title',
         'description',
         'image',
         'is_active'
     ];

     public function images(){
         return $this->hasMany(Media::  class,'gallery_id');
     }
}
