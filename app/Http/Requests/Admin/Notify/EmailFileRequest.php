<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
                'file_path.*' => 'required|file|mimes:png,jpg,jpeg,gif,pdf,zip,docx,doc',
                'storage_location' => 'required|in:storage,public',
                'status' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'file_path.*' => 'nullable|file|mimes:png,jpg,jpeg,gif,pdf,zip,docx,doc',
                'storage_location' => 'required|in:storage,public',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
