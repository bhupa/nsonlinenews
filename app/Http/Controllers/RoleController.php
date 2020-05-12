<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    protected  $role;

    public function __construct(RoleRepository $role){

        $this->role= $role;
    }

    public function index(){
        $perpage = '7';
        $roles = $this->role->paginate($perpage);
        return view('backend.role.index', compact('roles'));
    }
    public function create(){
        return view('backend.role.add');
    }
    public function store(RoleStoreRequest $request){
       $this->role->create($request->except('_token'));
       return redirect()->route('role.index')->with('success','Role Added Successfully');
    }
    public function edit($id){
        $role = $this->role->findOrfail($id);
        return view('backend.role.edit',compact('role'));

    }
    public function update(RoleUpdateRequest $request, $id){
        $input = $request->except('_token');
        $this->role->update($input,$id);
        return redirect()->route('role.index')->with('success','Role Update Successfully');
    }
    public function destroy(Request $request){
        $rules = ['id'=>'required'];
        $message = ['id.required' => 'please inser the id'];
        $validator = Validator::make(Input::all(), $rules, $message);

        if( $validator->fails()){

            return response()->json(['status' => false, 'message'=>$validator->errors->all()]);
        }
        else {
            $role= $this->role->findOrfail(Input::get('id'))->delete();
            return response()->json(['status' =>true, 'message' =>'Role Deleted SuccessFull']);
        }
    }
}
