<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\VideoRequest;
use App\Repositories\Video\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VideoController extends Controller
{
    protected $video;
    public function __construct(VideoRepository $video)
    {
        $this->video = $video;
    }

    public function index(){
        $videos = $this->video->orderBy('created_at', 'desc')->paginate('10');
        return view('backend.video.index')->withVideos($videos);
    }
    public function create(){
        return view('backend.video.create');
    }
    public function store(VideoRequest $request){
        $data= $request->except(['_token']);
        $rx = '~
  ^(?:https?://)?                           # Optional protocol
   (?:www[.])?                              # Optional sub-domain
   (?:youtube[.]com/watch[?]v=|youtu[.]be/) # Mandatory domain name (w/ query string in .com)
   ([^&]{11})                               # Video id of 11 characters as capture group 1
    ~x';
        $url = $request->url;
        if(preg_match($rx ,$url)){
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            $data['url'] = $url = $my_array_of_vars['v'];

        }
        else{
            return redirect()->back()->withErrors(['url'=>'vidoe link is not Valid']);
        }
        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $fetch=explode("v=", $request->url);
        $videoid=$fetch[1];
        $data['image'] = 'http://img.youtube.com/vi/'.$videoid.'/2.jpg';

        if( $this->video->create($data)){
            return redirect()->route('videos.index')->with(['success'=>trans("validation.custom.video.create")]);
        }
        return redirect()->back()->withInput()->with('success','Video can not be added');
    }
    public function edit($id){
        $video = $this->video->find($id);
        return view('backend.video.edit')->withVideo($video);
    }
    public function update(Request $request, $id){
        $video = $this->video->find($id);
        $data= $request->except(['_token']);
        $rx = '~
  ^(?:https?://)?                           # Optional protocol
   (?:www[.])?                              # Optional sub-domain
   (?:youtube[.]com/watch[?]v=|youtu[.]be/) # Mandatory domain name (w/ query string in .com)
   ([^&]{11})                               # Video id of 11 characters as capture group 1
    ~x';
        $url = $request->url;
        if(preg_match($rx ,$url)){
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            $data['url'] = $url = $my_array_of_vars['v'];
        }
        else{
            return redirect()->back()->withErrors(['url'=>'vidoe link is not Valid']);
        }
        $data['is_active'] = isset($request['is_active'])  ? '1':'0';
        $fetch=explode("v=", $request->url);
        $videoid=$fetch[1];
        $data['image'] = 'http://img.youtube.com/vi/'.$videoid.'/2.jpg';

        if( $this->video->update( $video->id,$data)){
            return redirect()->route('videos.index')->with(['success'=>trans("validation.custom.video.update")]);
        }
        return redirect()->back()->withInput()->with('success','Video can not be added');
    }
    public function destroy()
    {

        $this->video->findOrfail(Input::get('id'))->delete();
        return response()->json(['status'=> true, 'message'=>trans("validation.custom.video.delete")]);
    }
    public function change_status(){
        $video = $this->video->findOrFail(Input::get('id'));
        if ($video->is_active == 1) {

            $video->is_active = "0";
            $message = 'Video unpublished successfully.';
        } else {

            $video->is_active  = "1";
            $message = 'Video published successfully.';
        }

        $this->video->update(Input::get('id'), ['name' =>$video->name,'is_active' =>$video->is_active]);



        return response()->json(['status' => true, 'message' => $message, 'is_active' => $video->is_active]);

    }
}
