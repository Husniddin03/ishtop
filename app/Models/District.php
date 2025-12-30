<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'region_id',
        'soato_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];

    /**
     * District -> Region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * District -> Villages
     */
    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
