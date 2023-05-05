<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|min:2|max:190',
                'slug' => 'nullable|unique:posts|min:2|max:190',
                'summary' => 'required|min:2|max:400',
                'body' => 'required|min:2',
                'image_path' => 'required|image|mimes:png,jpg,jpeg,gif',
                'tags' => 'nullable',
                'commentable' => 'required|numeric|in:0,1',
                'status' => 'required|numeric|in:0,1',
                'category_id' => 'required|numeric|exists:App\Models\Content\PostCategory,id',
                'published_at' => 'required|numeric',
            ];
        } else {
            return [
                'title' => 'required|min:2|max:250',
                'slug' => 'nullable|unique:posts|min:2|max:250',
                'summary' => 'required|min:2|max:400',
                'body' => 'required|min:2',
                'image_path' => 'image|mimes:png,jpg,jpeg,gif',
                'tags' => 'nullable',
                'commentable' => 'required|numeric|in:0,1',
                'status' => 'required|numeric|in:0,1',
                'category_id' => 'required|numeric|exists:post_categories,id',
                'published_at' => 'numeric',
            ];
        }
    }
}
