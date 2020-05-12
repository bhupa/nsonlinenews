<?php

namespace App\Model\Permission;

use App\Model\RolePermission\RolePermisiom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
     protected $table= 'permission';

     protected $fillable = ['name','slug'];
     public function roles(){
         return $this->hasMany('role','role_id');
     }

}
