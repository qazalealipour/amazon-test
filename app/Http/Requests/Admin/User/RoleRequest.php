<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $route = Route::current();
        if ($route->getName() == 'admin.users.roles.store') {
            return [
                'name' => 'required|min:2|max:120',
                'description' => 'nullable|max:500',
                'status' => 'required|numeric|in:0,1',
                'permissions.*' => 'nullable|exists:permissions,id',
            ];
        } elseif ($route->getName() == 'admin.users.roles.update') {
            return [
                'name' => 'required|min:2|max:120',
                'description' => 'nullable|max:500',
                'status' => 'required|numeric|in:0,1',
            ];
        } elseif ($route->getName() == 'admin.users.roles.permission-update') {
            return [
                'permissions.*' => 'nullable|exists:permissions,id',
            ];
        }
    }

    public function attributes()
    {
        return [
            'name' => 'عنوان نقش',
            'permissions.*' => 'دسترسی',
        ];
    }
}
