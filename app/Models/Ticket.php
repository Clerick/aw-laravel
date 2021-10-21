<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    public $fillable = [
        'subject',
        'user_name',
        'user_email'
    ];

    protected static function booted()
    {
        static::creating(function ($ticket) {
            $ticket->uid = Str::uuid();
        });
    }
}
