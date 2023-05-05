<?php

namespace App\Models\Market;

use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmazingSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'amazing_sales';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
