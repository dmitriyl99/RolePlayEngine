<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Area extends Model
{

    use HasSlug, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get Area's locations
    */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get Area's places
    */
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    /**
     * Add location to the Area
     *
     * @param $location_data array Location data
     * @return Location
     */
    public function addLocation($location_data)
    {
        return $this->locations()->create($location_data);
    }

    /**
     * Add place to the Area
     *
     * @param $place_data array Place data
     * @return Place
     */
    public function addPLace($place_data)
    {
        return $this->places()->create($place_data);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
