<?php

namespace App\Http\ViewComposers;

use App\Model\Menulocation\Menulocation;
use Illuminate\View\View;
use App\Model\Category\Category;

class NavbarComposer {



    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menu = Menulocation::where('name','header')->first();
        $categories= $menu->category->where('is_active','1')->all();
        $view->with('categories',$categories);
    }


}