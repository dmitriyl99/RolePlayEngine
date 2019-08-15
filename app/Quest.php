<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        'name', 'description', 'gave_by', 'gave_at', 'period', 'hero_id'
    ];

    /**
     * Hero of this quest
    */
    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }
}
