<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\NewsStoreRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\SubCategory\SubCategoryRepository;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $news,$subcategory,$category;

    public function __construct(NewsRepository $news, CategoryRepository $category, SubCategoryRepository $subcategory)
    {
        $this->news = $news;
        $this->category= $category;
        $this->subcategory = $subcategory;
    }

    public function index()
    {

         $perpage = 10;
        $news = $this->news->orderBy('created_at','asc')->paginate(30);
        
return view ('backend.news.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Auth::user();
        $categories = $users->category()->where('is_active','1')->orderBy('orderlist','ASC')->get();
        return view('backend.news.add',compact('categories'));
    }


    public function getSubcategories(Request $request){

       $subcategories = $this->subcategory->where('category_id', $request->category_id)->get(['id','name']);
       if( $subcategories->isEmpty()){
           return response()->json(array('success'=>false, 'subcategory'=>$subcategories));
       }
        return response()->json(array('success'=>true, 'subcategory'=>$subcategories));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
//        $request->slug =  str_slug($request->title);
            $data= $request->except(['image']);
            if($request->get('image')){
                $saveName = sha1(date('YmdHis').str_random(3));
                $image = $request->get('image');
                $image = str_replace('data:image/png;base64','',$image);
                $image= str_replace('','+',$image);
                $imageData= base64_decode($image);
                $data['image'] = 'news/'.$saveName.'.png';
                Storage::put($data['image'],$imageData);


            }

            $data['is_active'] = isset($request['is_active'])  ? '1':'0';
            $data['created_by'] = Auth::user()->id;
             $data['slug'] =preg_replace('/\s+/', '-', $request->title);
	         
            if( $this->news->create($data)){
                return redirect()->route('ne_ws.index')->with(['success'=>trans("validation.custom.category.create")]);
            }
             return redirect()->back()->withInput()->with('success','News ican not be added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $new = $this->news->find($id);
        $categories = $this->category->where('is_active','1')->orderBy('orderlist','ASC')->get();
        return view('backend.news.edit', compact('new','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $id)
    {

        $data= $request->except(['image','_token']);
        $new = $this->news->find($id);
        if($request->get('image')){
            $saveName = sha1(date('YmdHis').str_random(3));
            $image = $request->get('image');
            $image = str_replace('data:image/png;base64','',$image);
            $image= str_replace('','+',$image);
            $imageData= base64_decode($image);
            $data['image'] = 'news/'.$saveName.'.png';
            Storage::put($data['image'],$imageData);
        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $data['created_by'] = Auth::user()->id;

        $data['slug'] =preg_replace('/\s+/', '-', $request->title);
   
        if($this->news->update($new->id,$data)){
            return redirect()->route('ne_ws.index')->with(['success'=>trans("validation.custom.category.update")]);
        }
        return redirect()->back()->withInput()->with('success','News can not be update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $this->news->find($request->id)->delete();
       return response()->json(['status'=>true, 'message'=>'News Dleted SUccessfully']);
    }
    public  function change_status(Request $request){
        $new = $this->news->find($request->id);
         if($new->is_active == 1){
             $new['is_active'] = '0';
             $message = 'News UnPublished Successfully';
         }
         else{
             $new['is_active'] = '1';
             $message = 'News Published Successfully';
         }

         $this->news->update($request->id, ['is_active' => $new['is_active']]);

         return response()->json(['success' => true, 'message'=>$message, 'is_active'=>$new['is_active']]);

    }


}
