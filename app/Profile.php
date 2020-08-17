<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'confirmed'
    ];

    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }

    public function corrections()
    {
        return $this->hasMany(ProfileCorrection::class);
    }
}
