<?php

namespace App\Models\Market;

use App\Models\Market\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
