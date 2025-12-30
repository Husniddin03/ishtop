<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'soato_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];

    /**
     * Region -> Districts
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
