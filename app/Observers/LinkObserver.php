<?php
/**
 * Created by PhpStorm.
 * User: wuxiaomin
 * Date: 2018/7/9
 * Time: 08:58
 */

namespace App\Observers;


use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }

}