<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }
}
