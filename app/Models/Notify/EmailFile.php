<?php

namespace App\Models\Notify;

use App\Models\Notify\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public_mail_files';
    protected $guarded = [];

    public function email()
    {
        return $this->belongsTo(Email::class, 'public_mail_id');
    }
}
