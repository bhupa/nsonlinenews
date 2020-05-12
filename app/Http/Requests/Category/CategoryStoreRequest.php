<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' =>'required|unique:category',
            'is_active'=>'required',
            'display_in'=>'required',
            'orderlist'=>'required|unique:category'
        ];
    }
    public function message(){
        return [
            'name.required' =>'PLease Insert the Unique Name',
            'is_active.required' =>'Please Insert Publish',
            'display_in.required' =>'Please Insert display',
            'orderlist.required' =>'Please Insert orderlist'
        ];
    }
}
