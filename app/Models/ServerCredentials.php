<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class ServerCredentials extends Model
{
    use HasFactory;

    public $fillable = [
        'ftp_login',
        'ftp_password'
    ];

    public $casts = [
        'ftp_login' => 'encrypted',
        'ftp_password' => 'encrypted'
    ];

    public $timestamps = false;

    public function message()
    {
        $this->belongsTo(Message::class);
    }
}
