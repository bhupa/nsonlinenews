<?php

namespace App\Model\Category;

use App\Model\CategoryLocation\CategoryLocation;
use App\Model\Menulocation\Menulocation;
use App\Model\News\News;
use App\Model\SubCategory\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name','display_in','orderlist','is_active'];

    public function child(){

    return $this->hasMany( SubCategory::class,'category_id');
    }
//public function menulocation(){
//        return $this->hasMany(Menulocation::class,'display_in');
//}

    public function menulocation(){

        return $this->belongsToMany( Menulocation::class, 'category_location', 'category_id','menu_id');
    }
    public function news(){
        return $this->hasMany(News::class, 'category_id')->where('is_active','1');
    }

    public function bibidaha(){
        return $this->hasMany( SubCategory::class,'category_id')->where('name','साहित्य')->get();
    }
}
