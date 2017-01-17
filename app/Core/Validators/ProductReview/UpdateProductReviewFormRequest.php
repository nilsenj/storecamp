<?php

namespace App\Core\Validators\ProductReview;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductReviewFormRequest extends FormRequest
{
    /**
     * Access is presented in middleware layer
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
            "unique_id" => "string|unique:product_reviews,unique_id,". $this->id,
            "product" => "required|string|min:3,max:255",
            "message" => "required|string|min:25,max:1000",
            "reason" => "required|string|min:2,max:60"
        ];
    }
}
