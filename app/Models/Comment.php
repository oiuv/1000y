<?php

namespace App\Models;

class Comment extends Reply
{
    protected $table = 'replies';
    public $timestamps = false;

    public function account()
    {
        return $this->belongsTo(Account::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'topic_id');
    }
}
