<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValueRequest extends FormRequest
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
            'value' => 'required|min:2|max:190',
            'price_increase' => 'required|numeric',
            'type' => 'required|numeric|in:0,1',
            'product_id' => 'nullable|numeric|exists:products,id',
        ];
    }
}
