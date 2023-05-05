<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public_mail';
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(EmailFile::class, 'public_mail_id');
    }
}
