<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryUpdateRequest extends FormRequest
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
            'name' =>'required|unique:sub_categories,name,'.$this->id,
            'display_in'=>'required|integer|unique:sub_categories,display_in,'.$this->id,

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
