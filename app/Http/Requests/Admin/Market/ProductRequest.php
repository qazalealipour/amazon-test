<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|max:120|min:2',
                'description' => 'required|min:2',
                'image_path' => 'required|image|mimes:png,jpg,jpeg,gif',
                'price' => 'required|numeric',
                'weight' => 'required|numeric',
                'length' => 'required|numeric',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'tags' => 'nullable',
                'marketable' => 'required|numeric|in:0,1',
                'status' => 'required|numeric|in:0,1',
                'brand_id' => 'required|numeric|exists:brands,id',
                'category_id' => 'required|numeric|exists:product_categories,id',
                'published_at' => 'required|numeric',
                'meta_key.*' => 'nullable',
                'meta_value.*' => 'nullable',
            ];
        } else {
            return [
                'name' => 'required|max:120|min:2',
                'description' => 'required|min:2',
                'image_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'price' => 'required|numeric',
                'weight' => 'required|numeric',
                'length' => 'required|numeric',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'tags' => 'nullable',
                'marketable' => 'required|numeric|in:0,1',
                'status' => 'required|numeric|in:0,1',
                'brand_id' => 'required|numeric|exists:brands,id',
                'category_id' => 'required|numeric|exists:product_categories,id',
                'published_at' => 'required|numeric',
            ];
        }
    }
}
