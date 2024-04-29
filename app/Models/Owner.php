<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
