<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryStoreRequest extends FormRequest
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

    public function rules()
    {

            return [
                'title' =>'required|unique:galleries',
                'image' =>'required',
                'description' =>'required',
                'is_active'=>'required'
            ];

    }
    public function message(){
        return [
            'title.required' =>'PLease Insert the Unique Name',
            'image.required' =>'PLease upload the image',
            'description.required' =>'Please insert the description ogf gallery',
            'is_active.required' =>'PLease Insert Publish'
        ];
    }
}
