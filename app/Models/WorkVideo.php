<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'url',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
