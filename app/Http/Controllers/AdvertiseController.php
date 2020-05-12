<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advertising\AdvertisingStoreRequest;
use App\Repositories\Advertising\AdvertisingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Image;


class AdvertiseController extends Controller
{
    protected $advertising;
    
    public function __construct(AdvertisingRepository $advertising)
    {
        $this->upload_path = DIRECTORY_SEPARATOR.'advertising'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
        $this->advertising = $advertising;
    }

    public function index(){
        $perpage = '10';
        $advertisings = $this->advertising->orderBy('created_at', 'desc')->paginate($perpage);
        return view('backend.advertising.index')->withAdvertisings($advertisings);
    }
    public function create()
    {
        return view('backend.advertising.create');
    }
    public function store(AdvertisingStoreRequest $request)
    {
        if($request->file('home-image')){
            $data= $request->except(['home-image']);
            $image= $request->file('home-image');
            $fileName = time().$image->getClientOriginalName();
            $location = $this->storage->put($this->upload_path. $fileName, file_get_contents($image->getRealPath()));
            $data['image'] = 'advertising/'.$fileName;
        }
        if($request->file('single-image')){
            $data= $request->except(['single-image']);
            $image= $request->file('single-image');
            $fileName = time().$image->getClientOriginalName();
            $location = $this->storage->put($this->upload_path. $fileName, file_get_contents($image->getRealPath()));
            $data['image'] = 'advertising/'.$fileName;
        }

            $data['is_active'] = isset($request['is_active'])  ? '1':'0';
            $data['single'] = isset($request['single'])  ? '1':'0';
            $data['popup'] = isset($request['popup'])  ? '1':'0';
            $data['home'] = isset($request['home'])  ? '1':'0';
            $this->advertising->create($data);
            return redirect()->route('advertise.index')->with(['success'=>trans("validation.custom.advertising.update")]);

    }
    public function edit($id)
    {

        $advertisings = $this->advertising->find($id);
        return view('backend.advertising.edit')->withAdvertisings($advertisings);
    }
    public function update(Request $request, $id){
        $advert = $this->advertising->find($id);
        if($request->file('home-image')){
            $data= $request->except(['home-image']);
            $image= $request->file('home-image');
            $fileName = time().$image->getClientOriginalName();
            $location = $this->storage->put($this->upload_path. $fileName, file_get_contents($image->getRealPath()));
            $data['image'] = 'advertising/'.$fileName;
        }
        if($request->file('single-image')){
            $data= $request->except(['single-image']);
            $image= $request->file('single-image');
            $fileName = time().$image->getClientOriginalName();
            $location = $this->storage->put($this->upload_path. $fileName, file_get_contents($image->getRealPath()));
            $data['image'] = 'advertising/'.$fileName;
        }

        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $data['single'] = isset($request['single'])  ? '1':'0';
        $data['popup'] = isset($request['popup'])  ? '1':'0';
        $data['home'] = isset($request['home'])  ? '1':'0';

        if($this->advertising->update($advert->id,$data)){
            return redirect()->route('advertise.index')->with(['success'=>trans("validation.custom.advertising.update")]);
        }
        return redirect()->back()->withInput()->with('success','Advertising can not be added');

    }
    public function destroy()
    {
        $this->advertising->findOrfail(Input::get('id'))->delete();
        return response()->json(['status'=> true, 'message'=>'Advertising Delete Successfully']);
    }
    public function change_status(){

        $advertisement = $this->advertising->findOrFail(Input::get('id'));

        if ($advertisement->is_active == 1) {

            $advertisement->is_active = "0";
            $message = 'Advertising unpublished successfully.';
        } else {

            $advertisement->is_active  = "1";
            $message = 'Advertising published successfully.';
        }

        $this->advertising->update(Input::get('id'), ['name' =>$advertisement->name,'is_active' =>$advertisement->is_active]);



        return response()->json(['status' => true, 'message' => $message, 'is_active' => $advertisement->is_active]);

    }
}
