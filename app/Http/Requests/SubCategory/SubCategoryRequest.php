<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubCategoryRequest extends FormRequest
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
            'category_id' =>  'required|not_in:0',
            'name' => 'required',
            'display_in'=>'required|unique:sub_categories'
        ];
    }
    public function message(){
        return [
            'category_id' => 'Please select from the list',
            'name.required' => 'Name Already Taken',
            'display_in.required' => 'Number Already Taken'
        ];
    }
}
