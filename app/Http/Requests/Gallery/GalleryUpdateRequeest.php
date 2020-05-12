<?php

namespace App\Http\Requests\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class GalleryUpdateRequeest extends FormRequest
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
            'title' =>'required|unique:galleries,title,'.$this->id,
            'image' =>'nullable',
            'description' =>'required',
            'is_active'=>'required'
        ];

    }
    public function message(){
        return [
            'title.required' =>'PLease Insert the Unique Name',
            'image.required' =>'PLease upload the image',
            'video.required' => 'please insert the youtube url',
            'description.required' =>'Please insert the description ogf gallery',
            'is_active.required' =>'PLease Insert Publish'
        ];
    }
}
