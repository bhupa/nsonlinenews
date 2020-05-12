<?php

namespace App\Model\SubCategory;

use App\Model\Category\Category;
use App\Model\News\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $table = 'sub_categories';
    protected $fillable = ['name','display_in','category_id'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function parent()
    {
        return $this->belongsTo(SubCategory::class, 'id');
    }
    public function getSubCategoryName(){

        return $this->category->name ? $this->category->name : "";

    }
    public function news(){
        return $this->hasMany(News::class, 'sub_category_id')->where('is_active','1');
    }
}
