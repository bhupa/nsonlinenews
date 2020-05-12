<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategory\SubCategoryRequest;
use App\Http\Requests\SubCategory\SubCategoryUpdateRequest;
use App\Model\SubCategory\SubCategory;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\SubCategory\SubCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;
    protected $subcategory;

    public function __construct(CategoryRepository $category, SubCategoryRepository $subcategory ){
        $this->category = $category;
        $this->subcategory = $subcategory;
    }
    public function index()
    {
        $perpage = '10';
        $subcategories = $this->subcategory->paginate($perpage);

//        $subcategories = SubCategory::orderBy('created_at','desc')->paginate($perpage);
        return view('backend.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->where('is_active','1')->get();
        return view('backend.subcategory.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {


        if(SubCategory::where(['category_id'=> $request['category_id'], 'name'=>$request['name'],'display_in'=>$request['display_in']])->exists()){
//            return redirect()->back()->withErrors(['name'=>'PLease insert the unique for this category']);
//dd('this is already satre');
            return redirect()->route('sub_category.add')->withErrors(['name'=>'This Name is Already save for this category','display_in'=>'This Display in is Already save for this category']);
        }

        else {
            $this->subcategory->create($request->except('_token'));
            return redirect()->route('sub_category.index')->with(['success'=>trans("validation.custom.sub category.create")]);

        }
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
        $categories = $this->category->where('is_active','1')->get();
        $subcategory = $this->subcategory->find($id);
       return view('backend.subcategory.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateRequest $request, $id)
    {
        $input = $request->except('_token');
        $this->subcategory->update($id, $input);
        return redirect()->route('sub_category.index')->with(['success'=>trans("validation.custom.sub category.update")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

        $this->subcategory->findOrfail(Input::get('id'))->delete();
        return response()->json(['status'=> true, 'message'=>'category Delete Successfully']);
    }
}
