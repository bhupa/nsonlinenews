<?php

namespace App\Model\RolePermission;

use App\Model\Permission\Permission;
use Illuminate\Database\Eloquent\Model;

class RolePermisiom extends Model
{
    protected  $table = 'role_permission';
    protected $fillable= ['role_id','permissiom_id'];
    public function roles(){
        return $this->hasMany('role','role_id');
    }
    public function permission(){

        return $this->hasMany('role_permission' ,'permissiom_id');
    }
}
