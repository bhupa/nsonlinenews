<?php

namespace App\Model\Popup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Popup extends Model
{
    use SoftDeletes;

    protected $table = 'popup';

    protected $fillable = ['title','image','is_active'];
}
