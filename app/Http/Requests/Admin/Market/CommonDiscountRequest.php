<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            'title' => 'required|min:2|max:190',
            'percentage' => 'required|numeric|min:1|max:100',
            'discount_ceiling' => 'nullable|numeric',
            'minimal_order_amount' => 'nullable|numeric',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
