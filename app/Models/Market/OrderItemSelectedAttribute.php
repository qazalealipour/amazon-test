<?php

namespace App\Models\Market;

use App\Models\Market\OrderItem;
use App\Models\Market\CategoryValue;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market\CategoryAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItemSelectedAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    public function categoryValue()
    {
        return $this->belongsTo(CategoryValue::class, 'category_value_id');
    }
}
