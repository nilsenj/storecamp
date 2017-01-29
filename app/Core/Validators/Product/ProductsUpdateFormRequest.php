<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/27/2015
 * Time: 8:17 PM
 */

namespace App\Core\Validators\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdateFormRequest extends FormRequest{



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
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $this->id,
            'body' => 'required',
            'price' => 'required',
        ];

    }

}