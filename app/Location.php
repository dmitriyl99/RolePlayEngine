<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * @var array
    */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get location's area
     *
     * @return mixed
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get location's places
     *
     * @return mixed
    */
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
