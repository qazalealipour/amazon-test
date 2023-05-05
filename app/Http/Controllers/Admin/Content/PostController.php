<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        // Date fix
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        if ($request->hasFile('image_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        $inputs['author_id'] = auth()->user()->id;
        $post = Post::create($inputs);
        return redirect()->route('admin.content.posts.index')->with('toastr-success', 'پست با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.edit', compact('post', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('published_at')) {
            // Date fix
            $realTimestampStart = substr($request->published_at, 0, 10);
            $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimestampStart);
        }

        if ($request->has('image_remove')){
            if ($request->input('image_remove') == 1) {
                $imageService->deleteDirectoryAndFiles($post->image_path['directory']);
                $inputs['image_path'] = null;
            }
            unset($inputs['image_remove']);
        }

        if ($request->hasFile('image_path')) {
                if (!empty($post->image_path)){
                    $imageService->deleteDirectoryAndFiles($post->image_path['directory']);
                }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
            unset($inputs['image_remove']);
        }
        // $inputs['slug'] = null;
        $post = $post->update($inputs);
        return redirect()->route('admin.content.posts.index')->with('toastr-success', 'ویرایش پست با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function changeStatus(Post $post)
    {
        $post->status = $post->status === 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function changeCommentable(Post $post)
    {
        $post->commentable = $post->commentable === 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->commentable === 0) {
                return response()->json(['commentable' => true, 'checked' => false]);
            } else {
                return response()->json(['commentable' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['commentable' => false]);
        }
    }
}
