<?php

namespace App\Models;


class Account extends User
{
    //后台管理用，关闭timestamps，否则报错。
    public $timestamps = false;
}
