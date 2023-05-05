<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'ticket_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function file()
    {
        return $this->hasOne(TicketFile::class);
    }
}
