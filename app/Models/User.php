<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'image',
    ];

    protected $hidden = [
        'password',
    ];

    /** RELATIONS */

    public function connections()
    {
        return $this->hasMany(UserConnection::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function worker()
    {
        return $this->hasMany(Worker::class);
    }
}
