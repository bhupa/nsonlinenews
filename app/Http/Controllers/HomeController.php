<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use App\Repositories\Advertising\AdvertisingRepository;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   protected $news,$advertisement;
   public function __construct(NewsRepository $news,AdvertisingRepository $advertisement)
   {
       $this->news = $news;
       $this->advertisement=$advertisement;
   }

    public function index()
    {
        $latests = $this->news->orderBy('created_at', 'des')->take(2)->get();
        return view('home')->withLatests($latests);
    }
}
