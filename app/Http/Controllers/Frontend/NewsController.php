<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $news,$category;

    public function __construct( NewsRepository $news, CategoryRepository $category)
    {
        $this->news = $news;
        $this->category = $category;

    }
     public function index(){
        $samachars = $this->category->where('name','समाचार')->where('is_active','1')->with('news')->get();
        return view('home')->withSamachars($samachars);
    }
    public function show($slug)
    {

        $count = $this->news->where('slug', $slug)->first();

        $mostviews = $this->news->where('category_id', $count['category_id'])->orderBy('view', 'DESC')->take(8)->get();
        $viewcount = $count['view'] + 1;
        $this->news->update($count['id'], ['view' => $viewcount]);

        $news = $this->news->find($count['id']);
        return view('news.show')->withNews($news)->withMostviews($mostviews);
    }
    public function store(){
        
    }

}
