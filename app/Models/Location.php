<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function Favourites()
    {
        return $this->hasMany(Favourite::class, 'location_id', 'id');
    }

    public function Owners()
    {
        return $this->hasMany(Owner::class, 'location_id', 'id');
    }

    public function Locations_languages()
    {
        return $this->hasMany(Locations_language::class, 'location_id', 'id');
    }
}
