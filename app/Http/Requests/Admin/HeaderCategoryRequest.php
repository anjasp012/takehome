<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeaderCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if (request()->routeIs('header-category.update')) {
            return [
                'name' => 'required|string|min:3',
                'photo' => 'image'
            ];
        }
        return [
            'name' => 'required|string|min:3',
            'photo' => 'required|image'

        ];
    }
}
