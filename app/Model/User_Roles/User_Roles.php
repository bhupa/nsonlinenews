<?php

namespace App\Model\User_Roles;

use App\Model\Role\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Roles extends Model
{
    protected $table= 'users_role';

    protected $fillable = ['role_id', 'user_id'];


public function role(){
    return $this->belongsTo( Role::class,'role_id');
}


}
