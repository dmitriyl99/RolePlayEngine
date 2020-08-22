<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const GAME_MASTER = 'game_master';
    public const ADMIN = 'admin';
    public const PLAYER = 'player';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
