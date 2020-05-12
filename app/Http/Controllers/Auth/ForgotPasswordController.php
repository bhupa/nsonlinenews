<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\PasswordChangeRequest;
use App\Mail\ForgetpasswordMail;
use App\Model\Password\password;
use App\Model\User\User;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function resetpassword(){

    return view('auth.passwords.email');
    }
    public function password(PasswordChangeRequest $request){
        $password= new password;
        $password->email = $request->email;
        $password->token = time().$request->_token;
        $password->created_at =  Carbon\Carbon::now()->toDateString();

        $password->save();
        Mail::to($password->email)->send(new ForgetpasswordMail($password));

        return view('auth.login')->with('success','Please Check your Email');
    }
    public function updatepassword (Request $request) {
//        samikshya
        $email = password::findOrfail($request->id);
        $user = User::where('email', $email->email)->first();

        $user->password = bcrypt($request->password);
        $user->save();
        return view('auth.login')->with('status', 'Password has been changed');

    }
    public function passwordlink($id){

        $password = password::find($id);
        if(is_null($password->token)){
            return view('auth.login')->withErrors(['email'=>'Token has been expire']);
        }

        return view('auth.passwords.reset',compact('password'));
    }
}
