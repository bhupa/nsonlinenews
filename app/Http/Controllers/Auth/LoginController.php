<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Password\password;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Model\User\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index(){
        return view('auth.login');
    }


    public function login( Request $request){
            if(session()->has('user_email') && session()->has('id')){
                return redirect()->route('dashboard');
            }
            elseif(auth()->attempt(['email' =>$request->email, 'password' =>$request->password])){

                $user =  Auth::user();
                session(['user_id' => $user->id]);
                session(['user_name' =>    $user->name]);
                session(['user_email' =>   $user->email]);

                self::afterlogin($user);
//                $password = password::where('email','=',$user->email)->update(['token'=>'Null']);
                return redirect()->route('admin.dashboard');
            }else {
                return Redirect::to('/')->with('loginerror', 'Your Credentials are not Matching');
            }
    }
    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        $this->performLogout($request);
        return Redirect::to ('/');
    }
    public function afterlogin($user){

        $permissions = collect();
        $roles = collect();

        foreach($user->roles as $use){
            $permissions->push($use->permission);
            $roles->push($use->id);
        }
        $access_permissions = [];
        foreach($permissions->flatten(1) as $index=>$permission){

            $access_permissions[] = $permission->slug;
        }

        $access_permissions = array_unique($access_permissions);
        
        session()->put('access_permissions',$access_permissions);
        session()->put('roles',$roles->toArray());

       return true;
    }
}
