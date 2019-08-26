<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
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
}
