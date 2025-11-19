<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type',
        'descrition',
        'date',
    ];

    /** RELATIONS */

    public function connections()
    {
        return $this->hasMany(WorkConnection::class);
    }

    public function locations()
    {
        return $this->hasMany(WorkLocation::class);
    }

    public function photos()
    {
        return $this->hasMany(WorkPhoto::class);
    }

    public function videos()
    {
        return $this->hasMany(WorkVideo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
