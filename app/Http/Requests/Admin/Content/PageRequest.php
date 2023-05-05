<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => 'required|min:2|max:120',
            'slug' => 'nullable|unique:pages|max:255',
            'body' => 'required|min:2',
            'tags' => 'nullable',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
