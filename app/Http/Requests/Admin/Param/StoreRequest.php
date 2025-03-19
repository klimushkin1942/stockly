<?php

namespace App\Http\Requests\Admin\Param;

use App\Enums\Param\FilterTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'filter_type' => 'required|integer|in:' . FilterTypeEnum::valuesAsString(),
        ];
    }
}
