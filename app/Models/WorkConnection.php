<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkConnection extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'name',
        'url',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
