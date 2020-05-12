<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
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
            'name' => 'required|unique:permission,name,'. $this->id,
            'slug' => 'required|unique:permission,slug,'. $this->id
        ];
    }
    public function message(){
        return [
            'name.required' => 'Permission Name is Alread Insert ',
            'slug.required' => 'Permission Slug Already Insert',

        ];
    }
}
