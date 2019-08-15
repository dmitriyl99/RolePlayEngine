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

    /**
     * The profile of hero
     */
    public function profile() 
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * The PDA of hero
     */
    public function pda() 
    {
        return $this->hasOne(Pda::class);
    }

    /**
     * Posts of this hero
    */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * All quests of this hero
    */
    public function quests()
    {
        return $this->hasMany(Quest::class);
    }

    /**
     * Not completed quests of this hero
    */
    public function notCompletedQuests()
    {
        return $this->quests()->where('done', false)->get();
    }

    /**
     * Completed quests of this hero
    */
    public function completedQuests()
    {
        return $this->quests()->where('done', true)->get();
    }
}
