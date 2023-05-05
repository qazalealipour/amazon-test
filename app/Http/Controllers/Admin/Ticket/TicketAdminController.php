<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketAdmins = User::where('user_type', '=', 1)->orderByDesc('created_at')->cursorPaginate(10);
        return view('admin.ticket.admin.index', compact('ticketAdmins'));
    }

    public function setAdmin(User $admin)
    {
        TicketAdmin::where('admin_id', '=', $admin->id)->first() ? TicketAdmin::where('admin_id', '=', $admin->id)->forceDelete() : TicketAdmin::create([
            'admin_id' => $admin->id,
            'status' => 1,
        ]);
        return back()->with('toastr-success', 'تغییر شما با موفقیت انجام شد');
    }
}
