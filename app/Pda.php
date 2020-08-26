<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pda extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'user_id'
    ];

    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
