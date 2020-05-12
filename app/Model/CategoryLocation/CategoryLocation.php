<?php

namespace App\Model\CategoryLocation;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryLocation extends Model
{
    protected $table= 'category_location';

    protected $fillable = ['category_id','menu_id'];

    public function categories(){
        return $this->hasMany(Category::class, 'category_id');
    }
}
