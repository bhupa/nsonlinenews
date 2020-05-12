<?php

namespace App\Http\ViewComposers;


use App\Model\Menulocation\Menulocation;
use App\Repositories\Advertising\AdvertisingRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\Popup\PopupRepository;
use App\Repositories\SubCategory\SubCategoryRepository;
use App\Repositories\Video\VideoRepository;
use Illuminate\View\View;
use App\Model\Category\Category;

class HomeComposer {



    protected $news,$category,$subcategory,$video,$advertisment, $popup;

    public function __construct(
        NewsRepository $news,
        CategoryRepository $category,
        GalleryRepository $gallery,
        SubCategoryRepository $subcategory,
        VideoRepository $video,
        AdvertisingRepository $advertisment,
        PopupRepository  $popup
    )
    {

        $this->category = $category;
        $this->gallery =$gallery;
        $this->subcategory =$subcategory;
        $this->video = $video;
        $this->advertisment =$advertisment;
        $this->popup = $popup;


    }
    public function compose(View $view)
    {
        $samachars = $this->category->where('is_active','1')->where('name','समाचार')->first();


        $sports =$this->category->where('is_active','1')->where('name','खेलकुद')->first();

        $information = $this->category->where('is_active','1')->where('name','सूचना प्रविधि')->first();
        $aboards = $this->category->where('is_active','1')->where('name','प्रवास')->first();
        $buissness = $this->category->where('is_active','1')->where('name','विजनेश')->first();
        $entertainments = $this->category->where('is_active','1')->where('name','मनोरन्जन')->first();
        $lifestyles = $this->category->where('is_active','1')->where('name','जीवनशैली')->first();
        $politics = $this->category->where('is_active','1')->where('name','राजनीति')->first();
        $states = $this->category->where('is_active','1')->where('name','प्रदेश संस्करण')->first();
        $galleries = $this->gallery->where('is_active','1')->latest()->orderBy('created_at','desc')->take(4)->get();
       $interviews = $this->subcategory->where('name','अन्तर्वार्ता')->first();
        $literatures = $this->subcategory->where('name','साहित्य')->first();
        $videos = $this->video->where('is_active','1')->latest()->take(4)->get();
         $singleadds =$this->advertisment->where('single','1')->where('is_active','1')->get();

        $popups = $this->popup->where('is_active', '1')->latest()->take(1)->get();
        $bibidhas = $this->category->where('is_active','1')->where('name','विविध')->first();
 $homeadds1 =$this->advertisment->where('home','1')->where('is_active','1')->latest()->take(1)->first();
        $homeadds2 =$this->advertisment->where('home','1')->where('is_active','1')->skip(1)->take(1)->first();
        $homeadds3 =$this->advertisment->where('home','1')->where('is_active','1')->skip(2)->take(1)->first();

        $homeadds4 =$this->advertisment->where('home','1')->where('is_active','1')->skip(3)->take(1)->first();
        $homeadds5 =$this->advertisment->where('home','1')->where('is_active','1')->skip(4)->take(1)->first();
        $homeadds6 =$this->advertisment->where('home','1')->where('is_active','1')->skip(5)->take(1)->first();
        $homeadds7 =$this->advertisment->where('home','1')->where('is_active','1')->skip(6)->take(1)->first();
        $homeadds8 =$this->advertisment->where('home','1')->where('is_active','1')->skip(7)->take(1)->first();
        $homeadds9 =$this->advertisment->where('home','1')->where('is_active','1')->skip(8)->take(1)->first();




        $view->with('samachars',$samachars)
            ->with('sports',$sports)
            ->with('information',$information)
            ->with('aboards',$aboards)
             ->with('buissness',$buissness)
            ->with('entertainments',$entertainments)
            ->with('lifestyles',$lifestyles)
            ->with('politics',$politics)
            ->with('states',$states)
            ->with('galleries', $galleries)
            ->withInterviews($interviews)
            ->withLiteratures($literatures)
            ->withVideos($videos)
            ->withPopups ( $popups )
            ->withBibidhas($bibidhas)
        ->withSingleadds( $singleadds)
->withHomeadds1( $homeadds1 )
            ->withHomeadds2( $homeadds2 )
        ->withHomeadds3( $homeadds3 )
            ->withHomeadds4( $homeadds4 )
            ->withHomeadds5( $homeadds5 )
            ->withHomeadds6( $homeadds6 )
            ->withHomeadds7( $homeadds7 )
            ->withHomeadds8( $homeadds8 )
            ->withHomeadds9( $homeadds9 );


    }


}
