<?php

namespace App\Model\User_category;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class User_Category extends Model
{
    protected $table = 'user_categories';

    protected $fillable =['category_id','user_id'];

    public function category(){
        return $this->hasMany( Category::class,'user_categories');
    }
}
