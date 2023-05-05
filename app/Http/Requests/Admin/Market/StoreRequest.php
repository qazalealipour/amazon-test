<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'receiver' => 'required|max:120|min:2',
            'deliverer' => 'required|max:120|min:2',
            'marketable_number' => 'required|numeric',
            'description' => 'nullable|max:520|min:2',
        ];
    }
}
