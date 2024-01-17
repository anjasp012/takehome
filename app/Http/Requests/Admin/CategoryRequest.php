<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('sub-header-category.update')) {
            return [
                'name' => 'required|string|min:3',
                'sub_header_category_id' => ['required', 'exists:sub_header_categories,id'],
                'photo' => 'image'
            ];
        }
        return [
            'name' => 'required|string|min:3',
            'sub_header_category_id' => ['required', 'exists:sub_header_categories,id'],
            'photo' => 'required|image'
        ];
    }
}
