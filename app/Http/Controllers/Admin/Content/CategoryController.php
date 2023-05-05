<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.content.category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PostCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            // $result = $imageService->save($request->file('image_path'));
            // $result = $imageService->fitAndSave($request->file('image_path'), 600, 450);
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        $postCategory = PostCategory::create($inputs);
        return redirect()->route('admin.content.categories.index')->with('toastr-success', 'دسته بندی با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Content\PostCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->has('image_remove')){
            if ($request->input('image_remove') == 1) {
                $imageService->deleteDirectoryAndFiles($postCategory->image_path['directory']);
                $inputs['image_path'] = null;
            }
            unset($inputs['image_remove']);
        }

        if ($request->hasFile('image_path')) {
            if (!empty($postCategory->image_path)) {
                $imageService->deleteDirectoryAndFiles($postCategory->image_path['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image_path'));
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image_path'] = $result;
        }
        // $inputs['slug'] = null;
        $postCategory->update($inputs);
        return redirect()->route('admin.content.categories.index')->with('toastr-success', 'ویرایش دسته بندی با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return back();
    }

    public function changeStatus(PostCategory $postCategory)
    {
        $postCategory->status = $postCategory->status === 0 ? 1 : 0;
        $result = $postCategory->save();
        if ($result) {
            if ($postCategory->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
