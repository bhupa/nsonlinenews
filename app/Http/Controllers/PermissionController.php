<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Model\Permission\Permission;
use App\Repositories\Permission\PermissionRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $permission;

    public function __construct(PermissionRepository $permission){

        $this->permission = $permission;

    }
    public function index()
    {
        $perPage = 10;
        $permissions = $this->permission->paginate($perPage);
       return view('backend.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->permission->create($request->except('_token'));
        return redirect()->route('permission.index')->with('success','Permission Created SuccessFully');
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
        $permission = $this->permission->findOrFail($id);
        return view('backend.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $this->permission->update($input, $id);
        return redirect()->route('permission.index')->with('success','Permission Update SuccessFully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = ['id'=>'required'];
        $message = ['id.required' => 'please inser the id'];
        $validator = Validator::make(Input::all(), $rules, $message);

        if( $validator->fails()){

            return response()->json(['status' => false, 'message'=>$validator->errors->all()]);
        }
        else {
            $permission= $this->permission->findOrfail(Input::get('id'))->delete();
            return response()->json(['status' =>true, 'message' =>'Permission Deleted SuccessFull']);
        }
    }
}
