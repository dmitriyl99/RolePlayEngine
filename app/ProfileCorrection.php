<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileCorrection extends Model
{
    protected $fillable = [
        'description', 'user_id'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
