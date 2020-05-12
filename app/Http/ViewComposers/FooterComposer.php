<?php

namespace App\Http\ViewComposers;

use App\Model\Menulocation\Menulocation;
use Illuminate\View\View;
use App\Model\Category\Category;

class FooterComposer {



    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menu = Menulocation::where('name','footer')->first();
        $subcategories= $menu->category;
        $view->with('subcategories',$subcategories);
    }


}