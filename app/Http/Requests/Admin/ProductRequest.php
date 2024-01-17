<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'name' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'discon_price' => 'nullable|integer',
            'description' => 'required',
            'link_youtube' => 'required',
            'size_s' => 'nullable',
            'size_m' => 'nullable',
            'size_l' => 'nullable',
            'size_xl' => 'nullable',
            'size_xxl' => 'nullable',
        ];
    }
}
