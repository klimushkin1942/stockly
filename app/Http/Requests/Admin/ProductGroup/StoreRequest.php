<?php

namespace App\Http\Requests\Admin\ProductGroup;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>l
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }
}
