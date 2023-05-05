<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'name' => 'required|min:2|max:120',
            'slug' => 'nullable|unique:product_categories|max:255',
            'description' => 'nullable|max:500',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'tags' => 'nullable',
            'show_in_menu' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|numeric|exists:product_categories,id',
        ];
    }
}
