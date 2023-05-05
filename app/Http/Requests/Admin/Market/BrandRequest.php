<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'persian_name' => 'required|min:2|max:120|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'original_name' => 'required|min:2|max:120',
            'slug' => 'nullable|unique:brands|max:255',
            'description' => 'nullable|max:500',
            'logo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'tags' => 'nullable',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
