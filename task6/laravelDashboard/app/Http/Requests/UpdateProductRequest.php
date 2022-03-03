<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => ['required', 'string', 'between:3,255'],
            'name_ar' => ['required', 'string', 'between:3,255'],
            'price' => ['required', 'numeric', 'max:999999.99', 'min:0.5'],
            'quantity' => ['nullable', 'integer', 'between:1,9999'],
            'code' => ['required', Rule::unique('products')->ignore(request()->route('id')), 'digits:5'],
            'status' => ['nullable', 'integer', Rule::in([0, 1])],
            'des_en' => ['required', 'string'],
            'des_ar' => ['required', 'string'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'sub_category_id' => ['required', 'integer', 'exists:sub_categories,id'],
            'image' => ['nullable', 'max:1024', 'mimes:png,jpg,jpeg']
        ];
    }
}
