<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use App\Http\Services\File\FileService;
use App\Http\Requests\Customer\Profile\Ticket\TicketRequest;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->whereNull('ticket_id')->get();
        return view('customer.profile.tickets', compact('tickets'));
    }

    public function create()
    {
        $ticketCategories = TicketCategory::all();
        $ticketPriorities = TicketPriority::all();
        return view('customer.profile.create', compact('ticketCategories', 'ticketPriorities'));
    }

    public function store(TicketRequest $request, FileService $fileService)
    {
        DB::transaction(function () use($request, $fileService){
            $inputs = $request->all();
            $inputs['user_id'] = auth()->user()->id;
            $ticket = Ticket::create($inputs);
            //file
            $inputs = $request->all();
            if ($request->hasFile('file_path')) {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
                $fileService->setFileSize($request->file('file_path'));
                $fileSize = $fileService->getFileSize();
                if ($request->input('storage_location') == 'storage') {
                    $result = $fileService->moveToStorage($request->file('file_path'));
                } else {
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
            $inputs['ticket_id'] = $ticket->id;
            $inputs['user_id'] = auth()->user()->id;
            $file = TicketFile::create($inputs);
            return redirect()->route('customer.profile.my-tickets')->with('toastr-success', 'تیکت شما با موفقیت ثبت شد');
        });
    }

    public function show(Ticket $ticket)
    {
        return view('customer.profile.show-ticket', compact('ticket'));
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['seen'] = 0;
        $inputs['ticket_id'] = $ticket->id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['reference_id'] = $ticket->reference_id;
        $comment = Ticket::create($inputs);
        return redirect()->route('customer.profile.my-tickets')->with('toastr-success', 'پاسخ شما با موفقیت ثبت شد');
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status === 1 ? 0 : 1;
        $ticket->save();
        return back()->with('toastr-success', 'تغییر با موفقیت انجام شد');
    }
}
