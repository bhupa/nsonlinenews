<?php

namespace App\Model\Advertising;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertising extends Model
{
    use SoftDeletes;

    protected $table = 'advertising';

    protected $fillable = ['title','image','is_active','popup','home','single'];
}
