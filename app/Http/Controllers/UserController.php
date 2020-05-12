<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use App\Model\Role\Role;
use App\Model\User_category\User_Category;
use App\Model\User_Roles\User_Roles;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(){


        $perpage ='20';
        $users =$this->user->paginate($perpage);
        return view('backend.user.index', compact('users'));
    }
    public function change_status(Request $request){

        $user = $this->user->find($request->id);

        if( $user->is_active == '1'){
            $user['is_active'] = '0';
            $message = 'User Deactivate successfully';
        }
        else{
            $user ['is_active'] = '1';
            $message = 'User Activate successfully';
        }

        $this->user->update($user->id, ['is_active'=> $user ['is_active']]);

        return response()->json(['status'=>true, 'message' =>$message, 'is_active' =>  $user ['is_active']]);

    }
    public function asignrole($id){

        $userroles = User_Roles::where('user_id',$id)->get();

        $users = $this->user->find($id);

        $roles = Role::all();
        return view('backend.user.assignrole',compact('roles','userroles','users'));
    }
    public function storerole(Request $request,$id){

        $roles_id = explode(',',$request->role_id);
        $input =[];

        foreach ( $roles_id  as $key=> $role) {

            $useroles = User_Roles::firstOrCreate([
                'user_id' => $id,
                'role_id' => $role,
            ]);

            $useroles->save();

        }



       return redirect()->route('user.index')->with('success', 'Successfully Role is Assign To User');
    }
    public function deleterole(Request $request){
         $userrole = User_Roles::where(['user_id'=>$request->user_id, 'role_id'=>$request->role_id])->delete();

        return response()->json(['status' =>true, 'message' =>'UserRole Deleted SuccessFull']);
    }
    public function assigncategory($id){
        $usercategories = User_Category::where('user_id',$id)->get();

        $users = $this->user->find($id);

        $categories = Category::all();
        return view('backend.user.assigncategory',compact('categories','usercategories','users'));
    }
    public function storecategory(Request $request,$id){

        $categories = explode(',',$request->category_id);

        foreach( $categories as  $category){

            $cat = User_Category::firstOrCreate([
                'user_id' => $id,
                'category_id'=> $category

            ]);


            $cat->save();
        }
        return redirect()->route('user.index')->with('success', 'Successfully Category is Assign To User');
    }

    public function deletecategory(Request $request){
        $category = User_Category::where(['category_id'=>$request->category_id, 'user_id'=>$request->user_id])->delete();
        return response()->json(['status' =>true, 'message' =>'UserRole Deleted SuccessFull']);
    }
    public function create(){

}
}
