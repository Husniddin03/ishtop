<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'price',
        'how_much_people',
        'gender',
        'age',
        'lunch',
        'description',
        'country',
        'region',
        'district',
        'village',
        'address',
        'read_count',
        'latitude',
        'longitude',
        'when',
        'start_time',
        'finish_time',
        'duration',
        'status'
    ];

    protected $casts = [
        'lunch' => 'boolean',
        'when'  => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(WorkImage::class);
    }
}
