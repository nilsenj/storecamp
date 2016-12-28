<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/27/2015
 * Time: 8:17 PM
 */

namespace App\Core\Validators\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductsFormRequest extends FormRequest{

    protected $rules = [
        'title' => 'required|min:2',
        'slug' => 'required|unique:products,slug',
        'body' => 'required|min:20',
        'price' => 'required|numeric',
        'image' => 'required',
        'availability' => 'integer',
        'category_id' => 'required|integer'
    ];


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
        return $this->rules;
    }

}