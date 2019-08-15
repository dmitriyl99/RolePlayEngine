<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'user_id', 'hero_id', 'place_id', 'area_id', 'location_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
