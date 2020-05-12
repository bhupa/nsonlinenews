<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Model\CategoryLocation\CategoryLocation;
use App\Model\Menulocation\Menulocation;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected  $category;
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $perpage = '10';
        $categories = $this->category->orderBy('orderlist', 'ASC')->paginate($perpage);
        $menuItems = Menulocation::pluck('name', 'id');
        return view('backend.category.index')->withCategories($categories)->withMenuItems( $menuItems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menulocation::all();
        return view('backend.category.add')->withMenus($menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {


        $data = $request->except('_token','display_in');
        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $this->category->create($data);
        $category = $this->category->where('name',$request->name)->first();
        $display_in= implode(", ", $request->display_in);
        $menus= explode(',',$display_in);
        $categorylocatrion =CategoryLocation::where('category_id',$category->id)->delete();
        foreach( $menus as $key => $menu){

            $Categorylocation = CategoryLocation::firstOrNew([
                'menu_id' => $menu,
                'category_id' =>  $category->id ,

            ]);

            $Categorylocation->save();
        }

        return redirect()->route('category.index')->with(['success'=>trans("validation.custom.category.create")]);
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
        $category= $this->category->findOrfail($id);
        $menus = Menulocation::all();
        return view('backend.category.edit')->withMenus($menus)->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        $category= $this->category->find($id);
        $data = $request->except('_token','display_in');
        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $this->category->update($category->id,$data);
        $display_in= implode(", ", $request->display_in);
        $menus= explode(',',$display_in);
        $categorylocatrion =CategoryLocation::where('category_id',$id)->delete();
        foreach( $menus as $key => $menu){
            $Categorylocation = CategoryLocation::firstOrNew([
                'menu_id' => $menu,
                'category_id' =>  $id ,

            ]);

            $Categorylocation->save();
        }
        return redirect()->route('category.index')->with(['success'=>trans("validation.custom.category.update")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

         $this->category->findOrfail(Input::get('id'))->delete();
        return response()->json(['status'=> true, 'message'=>'category Delete Successfully']);
    }
    public function change_status(){
        $objectContent = $this->category->findOrFail(Input::get('id'));
        if ($objectContent->is_active == 1) {

            $objectContent->is_active = "0";
            $message = 'Category unpublished successfully.';
        } else {

            $objectContent->is_active  = "1";
            $message = 'Category published successfully.';
        }

        $this->category->update(Input::get('id'), ['name' =>$objectContent->name,'is_active' =>$objectContent->is_active]);



        return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectContent->is_active]);

}
        public function sortable(Request $request){
            $categorieslist =[];
            foreach($request->positions as $position){
                $index = $position[0];
                $position =$position[1];
                $this->category->update($index,['orderlist' => $position]);
            }

            $perpage = '10';
            $menuItems = Menulocation::pluck('name', 'id');

            $categories = $this->category->orderBy('orderlist', 'ASC')->get();

            foreach($categories as $category){
                $cat['id'] = $category->id;
                $cat['name'] = $category->name;
                $cat['orderlist'] = $category->orderlist;
                foreach (explode(', ', $category->display_in) as $key=>$singleMenuKey){

                    $cat['display'][$key]= $menuItems[$singleMenuKey];

                }
//                $cat['display'] =  array_unique( $caty);
                $categorieslist []  =  $cat;
            }

            return json_encode(['status' => 'success','categorieslist'=>$categorieslist, 'value' => 'Successfully reordered.'], 200);
//            return view('category.sortable')->withCategories($categories)->withMenuItems( $menuItems);
        }
}
