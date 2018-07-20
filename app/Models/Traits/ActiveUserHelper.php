<?php
/**
 * Created by PhpStorm.
 * User: wuxiaomin
 * Date: 2018/7/20
 * Time: 01:36
 */

namespace App\Models\Traits;


use App\Models\User;

trait ActiveUserHelper
{

    public function getActiveUsers()
    {
        // 尝试从缓存中取出 cache_key 对应的数据。如果能取到，便直接返回数据。
        // 否则运行匿名函数中的代码来取出活跃用户数据，返回的同时做了缓存。
        return User::latest('lastdate')->limit(50)->get();
    }
}