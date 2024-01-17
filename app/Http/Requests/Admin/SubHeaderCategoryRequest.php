<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubHeaderCategoryRequest extends FormRequest
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
                'header_category_id' => ['required', 'exists:header_categories,id'],
                'photo' => 'image'
            ];
        }
        return [
            'name' => 'required|string|min:3',
            'header_category_id' => ['required', 'exists:header_categories,id'],
            'photo' => 'required|image'
        ];
    }
}
