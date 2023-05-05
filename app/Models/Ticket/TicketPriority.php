<?php

namespace App\Models\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ticket_priorities';
    protected $guarded = [];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'priority_id');
    }
}
