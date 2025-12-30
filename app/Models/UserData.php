<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{

    use HasFactory;

    protected $table = 'user_data';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'bio',
        'height',
        'weight',
        'birthday',
        'country',
        'region',
        'district',
        'village',
        'address',
        'latitude',
        'longitude'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
