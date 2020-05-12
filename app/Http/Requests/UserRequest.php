<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users,email',
            'contact' => 'required|unique:users,contact|digits:10',
            'image'  =>'required|mimes:jpeg,png,jpg|max:10240',
            'password'  =>'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];

    }
    public function message(){
        return [
            'firstname.required' => 'Please Insert First Name',
            'lastname.required' => 'Please Insert Last Name',
            'address.required' => 'Please Insert Address',
            'email.required' => 'This Email is Already Insert',
            'contact.required' => 'This Contact is Already Insert',
            'image.required' => 'Image must be jpeg png and jpg',
            'password.required' => 'Please Insert 6 Digits',
        ];
    }
}
