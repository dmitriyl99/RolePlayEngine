<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Place extends Model
{
    use SoftDeletes, HasSlug;
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
