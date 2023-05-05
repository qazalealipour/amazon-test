<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'common_discounts';
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
