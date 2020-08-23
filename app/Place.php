<?php

namespace App;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Place extends Model
{
    use SoftDeletes, HasSlug, HasImage;
    /**
     * @var array
    */
    protected $fillable = [
        'name', 'slug', 'description', 'img_url', 'area_id', 'location_id'
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

    public function getUploadDirectory(): string
    {
        return 'images/';
    }

    public function getImageAttributeName(): string
    {
        return 'img_url';
    }
}
