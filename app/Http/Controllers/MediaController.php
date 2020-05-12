<?php

namespace App\Http\Controllers;

use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Media\MediaRepository;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $media;
    protected $gallery;
    public function __construct(MediaRepository $media, GalleryRepository $gallery)
    {
        $this->media = $media;
        $this->gallery = $gallery;
    }

    public function index($id)
    {
        $gallery = $this->gallery->where('id',$id)->with('images')->first();
        return view('backend.gallery.image',compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $gallery =$this->gallery->find($id);
        return view('backend.gallery.uploadimage', compact('gallery'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $path = public_path('uploads/album/'.$id);
        $image  = $request->file('file');
        $filename = time()."__".$image->getClientOriginalName();
        if( $image->move($path,$filename)){
            $data['gallery_id'] = $id;
            $data['image'] = asset('uploads/album/'.$id.'/'.$filename);

            $this->media->create($data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $galleryImage = $this->media->find($request->id)->delete();
        $message = 'Image deleted successfully.';
        return response()->json(['status' => true, 'message' => $message ,'id' =>$request->id], 200);
    }
}
