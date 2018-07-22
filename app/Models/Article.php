<?php

namespace App\Models;

class Article extends Topic
{
    protected $table = 'topics';
    public $timestamps = false;

    public function account()
    {
        return $this->belongsTo(Account::class,'user_id');
    }
}
