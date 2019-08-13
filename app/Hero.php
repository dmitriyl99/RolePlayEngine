<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    /**
     * Массово присваиваемые атрибуты
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'nickname'
    ];

    /**
     * The owner of this hero
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function profile() 
    {
        return $this->hasOne(Profile::class);
    }
}
