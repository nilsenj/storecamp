<?php

namespace App\Core\Validation\Permission;

use Illuminate\Foundation\Http\FormRequest as Request;

class PermissionsFormRequest extends Request
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
            'name' => 'required|unique:permissions,name',
            'slug' => 'required|unique:permissions,slug',
            'description' => 'required|unique:permissions,description'
        ];
    }
}
