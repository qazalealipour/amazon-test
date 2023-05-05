<?php

namespace App\Models\Market;

use App\Models\Market\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}
