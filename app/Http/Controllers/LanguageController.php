<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function swap($lang){
        sesseion()->put('local',$lang);
        return redirect()->back();

    }
}
