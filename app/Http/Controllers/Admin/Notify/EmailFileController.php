<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\File\FileService;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
        return view('admin.notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Notify\EmailFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file_path')) {
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file_path'));
            $fileSize = $fileService->getFileSize();
            if ($request->input('storage_location') == 'storage'){
                $result = $fileService->moveToStorage($request->file('file_path'));
            }
            else{
                $result = $fileService->moveToPublic($request->file('file_path'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false) {
                return back()->with('toastr-error', 'آپلود فایل با خطا مواجه شد');
            }
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        $inputs['public_mail_id'] = $email->id;
        $file = EmailFile::create($inputs);
        return redirect()->route('admin.notify.email-files.index', [$email->id])->with('toastr-success', 'فایل با موفقیت ایجاد شد');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailFile $file)
    {
        return view('admin.notify.email-file.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Notify\EmailFileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $file, FileService $fileService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file_path')) {
            if (!empty($file->file_path)){
                if ($file->storage_location == 'storage'){
                    $fileService->deleteFile($file->file_path, true);
                }
                else{
                    $fileService->deleteFile($file->file_path);
                }
            }
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file_path'));
            $fileSize = $fileService->getFileSize();
            if ($request->input('storage_location') == 'storage'){
                $result = $fileService->moveToStorage($request->file('file_path'));
            }
            else{
                $result = $fileService->moveToPublic($request->file('file_path'));
            }
            $fileFormat = $fileService->getFileFormat();
            if ($result === false) {
                return redirect()->route('admin.notify.email-files.index', [$file->email->id])->with('toastr-error', 'آپلود فایل با خطا مواجه شد');
            }
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
        }
        $file->update($inputs);
        return redirect()->route('admin.notify.email-files.index', [$file->email->id])->with('toastr-success', 'ویرایش فایل با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $file)
    {
        $file->delete();
        return redirect()->route('admin.notify.email-files.index', [$file->email->id]);
    }

    public function changeStatus(EmailFile $file)
    {
        $file->status = $file->status === 0 ? 1 : 0;
        $result = $file->save();
        if ($result) {
            if ($file->status === 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
