<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'content', 'from_user_id', 'to_user_id', 'reply_to_id'
    ];

    public function read()
    {
        $this->setAttribute('read', true);
        $this->save();
    }

    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }


    /**
     * User who sent the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    /**
     * User who sent the message for
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }
}
