<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;

class Location extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get location's area
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get location's places
    */
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    /**
     * Add a place to the Location
     *
     * @param $place_data array Place data
     * @return Place
     */
    public function addPlace($place_data)
    {
        return $this->places()->create($place_data);
    }
}
