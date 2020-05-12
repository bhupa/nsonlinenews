<?php

namespace App\Model\Password;

use Illuminate\Database\Eloquent\Model;

class password extends Model
{
    protected  $table = 'password_resets';
    protected  $fillable = ['email','token'];
    public $timestamps = false;

}
