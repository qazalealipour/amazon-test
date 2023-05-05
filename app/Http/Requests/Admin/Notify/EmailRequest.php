<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
                'subject' => 'nullable|min:2|max:190',
                'body' => 'required|min:2',
                'status' => 'required|numeric|in:0,1',
                'published_at' => 'required|numeric',
            ];
        } else {
            return [
                'subject' => 'nullable|min:2|max:190',
                'body' => 'required|min:2',
                'status' => 'required|numeric|in:0,1',
                'published_at' => 'nullable|numeric',
            ];
        }
    }
}
