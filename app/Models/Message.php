<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Message extends Model
{
    use HasFactory;

    public const AUTHORS = [
        'client',
        'manager'
    ];

    public $fillable = [
        'author',
        'content'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
