<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'nullable|min:2|max:190',
            'description' => 'nullable|min:2',
            'keywords' => 'nullable|min:2',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif',
        ];
    }
}
