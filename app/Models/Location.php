<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'street_number',
        'postcode',
        'city',
        'capacity',
        'is_reservation_mandatory',
        'image_path',
        'reservation_link',
        'is_active',
        'image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Favourites()
    {
        return $this->hasMany(Favourite::class, 'location_id', 'id');
    }

    public function Owners()
    {
        return $this->hasMany(Owner::class, 'location_id', 'id');
    }

    public function Locations_language()
    {
        return $this->hasMany(Locations_language::class, 'location_id', 'id');
    }
}
