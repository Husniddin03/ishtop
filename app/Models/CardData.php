<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardData extends Model
{
    use HasFactory;
    protected $table = 'card_data';

    protected $fillable = [
        'user_id','number','date','name','phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
