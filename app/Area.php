<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * @var array
    */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get Area's locations
     *
     * @return mixed
    */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get Area's places
     *
     * @return mixed
    */
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
