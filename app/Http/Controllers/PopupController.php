<?php

namespace App\Http\Controllers;

use App\Http\Requests\Popup\PopupStoreRequest;
use App\Repositories\Popup\PopupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  protected $popup;
  public function __construct(PopupRepository $popup)
  {
      $this->popup = $popup;
  }

    public function index()
    {
        $perpage = '10';
        $popups = $this->popup->orderBy('created_at', 'desc')->paginate($perpage);
        return view('backend.popup.index')->withPopups($popups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.popup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PopupStoreRequest $request)
    {

        $data= $request->except(['image']);
        if($request->get('image')){
            $saveName = sha1(date('YmdHis').str_random(3));
            $image = $request->get('image');
            $image = str_replace('data:image/png;base64','',$image);
            $image= str_replace('','+',$image);
            $imageData= base64_decode($image);
            $data['image'] = 'popup/'.$saveName.'.png';
            Storage::put($data['image'],$imageData);

        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        if($this->popup->create($data)){
            return redirect()->route('popup.index')->with(['success'=>trans("validation.custom.popup.create")]);
        }
        return redirect()->back()->withInput()->with('success','Popup can not be added');

    }
    public function edit($id)
    {

        $popup = $this->popup->find($id);
        return view('backend.popup.edit')->withPopup($popup);
    }
    public function update(Request $request, $id){
        $popup = $this->popup->find($id);
        $data= $request->except(['image']);
        if($request->get('image')){
            $saveName = sha1(date('YmdHis').str_random(3));
            $image = $request->get('image');
            $image = str_replace('data:image/png;base64','',$image);
            $image= str_replace('','+',$image);
            $imageData= base64_decode($image);
            $data['image'] = 'popup/'.$saveName.'.png';
            Storage::put($data['image'],$imageData);

        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';

        if($this->popup->update($popup->id,$data)){
            return redirect()->route('popup.index')->with(['success'=>trans("validation.custom.popup.update")]);
        }
        return redirect()->back()->withInput()->with('success','Popup can not be added');

    }
    public function destroy()
    {
        $this->popup->findOrfail(Input::get('id'))->delete();
        return response()->json(['status'=> true, 'message'=>'Popup Delete Successfully']);
    }
    public function change_status(){

        $popup = $this->popup->findOrFail(Input::get('id'));

        if ($popup->is_active == 1) {

            $popup->is_active = "0";
            $message = 'Popup unpublished successfully.';
        } else {

            $popup->is_active  = "1";
            $message = 'Popup published successfully.';
        }

        $this->popup->update(Input::get('id'), ['name' =>$popup->name,'is_active' =>$popup->is_active]);



        return response()->json(['status' => true, 'message' => $message, 'is_active' => $popup->is_active]);

    }
}
