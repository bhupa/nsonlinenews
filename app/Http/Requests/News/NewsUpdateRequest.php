<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
            'title' => 'required|unique:news,title,'.$this->id,
            'category_id' => 'required|not_in:0|exists:category,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'publish_date' => 'required',
            'image' => 'nullable',
            'description' => 'required',
            'short_description' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is already Insert',
            'category_id.required' => 'Must be form category table',
            'sub_category_id.required' => 'Must be form sub category table',
            'publish_date.required' => 'Please insert the publish date',
            'image.required' => 'Please insert the Image',
            'description.required' => 'Please insert the News Description',
            'short_description.required' => 'Please insert the News Short Description',
        ];
    }
}
