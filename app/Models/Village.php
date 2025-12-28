<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'district_id',
        'soato_id',
        'name_uz',
        'name_oz',
        'name_ru',
    ];

    /**
     * Village -> District
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
