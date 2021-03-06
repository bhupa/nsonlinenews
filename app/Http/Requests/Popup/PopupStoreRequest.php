<?php

namespace App\Http\Requests\Popup;

use Illuminate\Foundation\Http\FormRequest;

class PopupStoreRequest extends FormRequest
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
            'title' =>'required|unique:popup',
            'image' =>'required',
            'is_active'=>'required'
        ];

    }
    public function message(){
        return [
            'title.required' =>'PLease Insert the Unique Name',
            'image.required' =>'PLease upload the image',
            'is_active.required' =>'PLease Insert Publish'
        ];
    }
}
