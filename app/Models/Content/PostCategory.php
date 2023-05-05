<?php

namespace App\Models\Content;

use App\Models\Content\Post;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'post_categories';
    protected $guarded = [];
    protected $casts = [
        'image_path' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
