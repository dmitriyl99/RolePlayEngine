<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quest extends Model
{
    use SoftDeletes;

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
