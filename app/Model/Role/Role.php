<?php

namespace App\Model\Role;

use App\Model\Permission\Permission;
use App\Model\User_Roles\User_Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    protected $table='role';

    protected $fillable =  ['name'];

    public function permission(){
        return $this->belongsToMany( Permission::class,'role_permission','role_id', 'permissiom_id');
    }
    public function users(){
        return $this->hasManyThrough(User_Roles::class,'roles');
    }
    public function roles(){

        return $this->belongsTo('users_role','role_id');
    }
}
