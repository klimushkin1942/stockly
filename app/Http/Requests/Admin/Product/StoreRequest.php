<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product.title' => 'required|string|max:255',
            'product.article' => 'required|string|max:255|unique:products,article',
            'product.description' => 'required|string',
            'product.content' => 'required|string',
            'product.product_group_id' => 'required|integer|exists:product_groups,id',
            'product.category_id' => 'required|integer|exists:categories,id',
            'product.count' => 'required|integer',
            'product.price' => 'required|numeric',
            'product.discount_price' => 'nullable|numeric',
            'product.images' => 'nullable|array',
            'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'params' => 'nullable|array',
            'params.*.id' => 'required|integer|exists:params,id',
            'params.*.value' => 'required|string',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'images' => $this->images ?? []
        ]);
    }
}
