<?php

namespace App\Model\User;

use App\Model\Category\Category;
use App\Model\Role\Role;
use App\Model\User_category\User_Category;
use App\Model\User_Roles\User_Roles;
use App\Model\User_type\User_type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

    protected $fillable =['firstname','lastname','username','password','email','image','contact','address','user_type','is_active'];

    protected $date = ['created_at','updated_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){

        return $this->belongsToMany(Role::class,'users_role');
    }
     public function user_roles()
     {
         return $this->hasMany(
             User_Roles::class, 'user_id'
         );
     }
    public function category(){
        return $this->belongsToMany(Category::class,'user_categories');
    }

    public function userType(){
        return $this->belongsTo(User_type::class, 'user_type');
    }
}
