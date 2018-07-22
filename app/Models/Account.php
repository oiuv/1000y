<?php

namespace App\Models;


class Account extends User
{
    //后台管理用，关闭timestamps，否则报错。
    public $timestamps = false;
    protected $hidden = ['remember_token'];

    public function Articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
