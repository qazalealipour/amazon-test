<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if ($this->isMethod('post')){
            return [
                'first_name' => 'required|min:2|max:120',
                'last_name' => 'required|min:2|max:120',
                'email' => 'required|string|unique:users|email',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'mobile' => 'required|numeric|digits:11|unique:users',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        }
        else{
            return [
                'first_name' => 'required|min:2|max:120',
                'last_name' => 'required|min:2|max:120',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        }
    }
}
