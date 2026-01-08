<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'file',
        'file_type',
        'is_read',
    ];

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }
}
