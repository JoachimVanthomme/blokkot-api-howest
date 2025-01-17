<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations_language extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'language',
        'hours',
        'info',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
