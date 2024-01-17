<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PopupRequest extends FormRequest
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
        return [
            'link' => ['required'],
            'isActive' => ['required'],
            'show' => ['required'],
            'title' => ['required'],
            'meta_keyword'  => ['required'],
            'meta_description'  => ['required'],
        ];
    }
}
