<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\GalleryStoreRequest;
use App\Http\Requests\Gallery\GalleryUpdateRequeest;
use Illuminate\Http\Request;
use App\Repositories\Gallery\GalleryRepository;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $gallery;

    public function __construct(GalleryRepository $gallery)
    {
        $this->gallery = $gallery;
    }

    public function index()
    {
        $perpage = '10';
        $galleries = $this->gallery->paginate($perpage);
        return view('backend.gallery.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gallery.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryStoreRequest $request)
    {

        $data= $request->except(['image']);
        if($request->get('image')){
            $saveName = sha1(date('YmdHis').str_random(3));
            $image = $request->get('image');
            $image = str_replace('data:image/png;base64','',$image);
            $image= str_replace('','+',$image);
            $imageData= base64_decode($image);
            $data['image'] = 'gallery/'.$saveName.'.png';
            Storage::put($data['image'],$imageData);

        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';

        if($this->gallery->create($data)){
            return redirect()->route('gallery.index')->with(['success'=>trans("validation.custom.gallery.create")]);
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
        $gallery = $this->gallery->find($id);
        return view('backend.gallery.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequeest $request, $id)
    {
        $data= $request->except(['image','_token']);
        $gallery = $this->gallery->find($id);
        if($request->get('image')){
            $saveName = sha1(date('YmdHis').str_random(3));
            $image = $request->get('image');
            $image = str_replace('data:image/png;base64','',$image);
            $image= str_replace('','+',$image);
            $imageData= base64_decode($image);
            $data['image'] = 'gallery/'.$saveName.'.png';
            Storage::put($data['image'],$imageData);
        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        if($this->gallery->update($gallery->id,$data)){
            return redirect()->route('gallery.index')->with(['success'=>trans("validation.custom.gallery.update")]);
        }
        return redirect()->back()->withInput()->with('success','Gallery can not be update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->gallery->find($request->id)->delete();
       return response()->json(['status' =>true, 'message' =>'Gallery Delete Succcessfully']);

    }
    public function change_status(Request $request){

        $gallery = $this->gallery->find($request->id);

        if($gallery->is_active == "1"){
            $gallery->is_active = '0';
            $message = 'Gallery Unpublished Successfully';
        }
        else{
            $gallery->is_active = "1";
            $message = 'Gallery Published Successfully';
        }

        $this->gallery->update($request->id, ['is_active'=>$gallery->is_active]);

        return response()->json(['status' => true, 'message' => $message, 'is_active' => $gallery->is_active]);
    }
}
