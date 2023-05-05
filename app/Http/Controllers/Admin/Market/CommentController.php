<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unseenComments = Comment::where('commentable_type', '=', 'App\Models\Content\Product')->where('seen', '=', 0)->cursor();
        foreach ($unseenComments as $unseenComment) {
            $unseenComment->seen = 1;
            $unseenComment->save();
        }
        $comments = Comment::where('commentable_type', '=', 'App\Models\Content\Product')->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.market.comment.index', compact('comments'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.market.comment.show', compact('comment'));
    }

    public function answer(CommentRequest $request, Comment $comment)
    {
        if ($comment->parent_id === null) {
            $inputs = $request->all();
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['seen'] = 1;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['author_id'] = 1;
            $comment = Comment::create($inputs);
            return redirect()->route('admin.market.comments.index')->with('toastr-success', 'پاسخ شما با موفقیت ثبت شد');
        } else {
            return back()->with('toastr-error', 'خطا!! امکان ثبت پاسخ وجود ندارد');
        }
    }

    public function changeStatus(Comment $comment)
    {
        $comment->status = $comment->status === 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function changeApproved(Comment $comment)
    {
        $comment->approved = $comment->approved === 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            return back()->with('toastr-success', 'وضعیت نظر با موفقیت تغییر کرد');
        } else {
            return back()->with('toastr-error', 'خطا در تغییر وضعیت نظر');
        }
    }
}
