<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\Models\ServerCredentials;
use App\Processors\EscapeString;
use App\Processors\BadWords;

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

    public function serverCredentials()
    {
        return $this->hasMany(ServerCredentials::class);
    }

    public function setContentAttribute(string $value)
    {
        $value = BadWords::process($value);
        $value = EscapeString::process($value);

        $this->attributes['content'] = $value;
    }
}
