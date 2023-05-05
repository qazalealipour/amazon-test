<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;

class TicketController extends Controller
{
    public function all()
    {
        $tickets = Ticket::whereNull('ticket_id')->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.ticket.index', compact('tickets'));
    }

    public function newTickets()
    {
        $tickets = Ticket::where('seen', '=', 0)->orderByDesc('created_at')->cursorPaginate(10);
        foreach ($tickets as $newTicket) {
            $newTicket->seen = 1;
            $newTicket->save();
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets()
    {
        $tickets = Ticket::where('status', '=', 0)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets = Ticket::where('status', '=', 1)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.ticket.show', compact('ticket'));
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status === 1 ? 0 : 1;
        $ticket->save();
        return back()->with('toastr-success', 'تغییر با موفقیت انجام شد');
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['seen'] = 1;
        $inputs['status'] = 1;
        $inputs['ticket_id'] = $ticket->id;
        $inputs['user_id'] = $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['reference_id'] = auth()->user()->ticketAdmin->id;
        $comment = Ticket::create($inputs);
        return redirect()->route('admin.tickets.all')->with('toastr-success', 'پاسخ شما با موفقیت ثبت شد');
    }
}
