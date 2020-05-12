<?php

namespace App\Model\Menulocation;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class Menulocation extends Model
{
    protected $table ="menulocation";
    protected $fillable =['name'];


    public function category()
    {
        return $this->belongsToMany( Category::class,'category_location','menu_id', 'category_id')->orderBy('orderlist','ASC');




    }
}
