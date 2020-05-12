<?php

namespace App\Model\News;

use App\Model\Category\Category;
use App\Model\SubCategory\SubCategory;
use App\Model\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{


    use SoftDeletes;

    protected $table = 'news';
    protected $fillable =[
        'title',
        'category_id',
        'sub_category_id',
        'short_description',
        'slug',
        'description',
        'publish_date',
        'created_by',
        'updated_by',
        'image',
        'is_active'
        ];

    public function category(){
       return $this->belongsTo(  Category::class,'category_id');
        }
    public function subcategory(){
        return $this->belongsTo(  SubCategory::class,'sub_category_id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
