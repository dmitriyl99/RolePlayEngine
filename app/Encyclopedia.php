<?php

namespace App;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Encyclopedia extends Model
{
    use HasSlug, HasImage;

    protected $fillable = [
        'title', 'description', 'full_description'
    ];

    /**
     * Articles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUploadDirectory(): string
    {
        return 'images/encyclopedia/';
    }

    public function getImageAttributeName(): string
    {
        return 'image';
    }
}
