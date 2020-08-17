<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileCorrection extends Model
{
    use SoftDeletes;

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
