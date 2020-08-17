<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;
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
