<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasImage, HasSlug;

    protected $fillable = [
        'title', 'content', 'encyclopedia_id'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUploadDirectory(): string
    {
        return 'articles/';
    }

    public function getImageAttributeName(): string
    {
        return 'image';
    }
}
