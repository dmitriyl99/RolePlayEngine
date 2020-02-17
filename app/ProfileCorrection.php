<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileCorrection extends Model
{
    protected $fillable = [
        'description'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
