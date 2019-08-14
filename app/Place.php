<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * @var array
    */
    protected $fillable = [
        'name', 'slug', 'description', 'img_url'
    ];

    /**
     * Get place's area
     *
     * @return mixed
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get place's location
     *
     * @return mixed
    */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
