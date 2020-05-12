<?php

namespace App\Model\User_type;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_type extends Model
{
    protected $table = 'user_type';

    protected $fillable= ['name'];
}
