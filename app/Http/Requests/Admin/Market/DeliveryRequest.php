<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'delivery_time' => 'required|numeric',
            'delivery_time_unit' => 'required|min:1|max:120',
            'status' => 'required|numeric|in:0,1',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'عنوان روش ارسال',
        ];
    }
}
