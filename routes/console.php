<?php

use Illuminate\Foundation\Inspiring;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('1000y:users', function () {
    $dir = config('database.sdb.userdata');
    if (Carbon::now()->hour > 3)
        $file = 'UserData'.date('Y-m-d').'.SDB';
    else
        $file = 'UserData'.Carbon::yesterday()->format('Y-m-d').'.SDB';
    $csv = new \ParseCsv\Csv();
    $csv->encoding('GBK', 'UTF-8');
    $csv->auto($dir.$file);
    $data = $csv->data;
    $this->info('开始缓存玩家数据(共'.count($data).'人)！');
//    try {
//        $cache = cache('1000yUsers');
//        if (is_null($cache)) {
//            $cache = [];
//        } else {
//            $cache = json_decode($cache, true);
//        }
//    } catch (\Exception $exception) {
//        $cache = [];
//    }
//    $data = array_merge($cache, $data);
    Cache::forever('1000yUsers', json_encode($data));
    //$bar = $this->output->createProgressBar(count($data));
    foreach ($data as $user) {
        //$this->performTask($user);
        Cache::forever('1000yUser:'.$user['PrimaryKey'], json_encode($user));
        //$bar->advance();
    }
    //$bar->finish();
    $this->info('玩家数据缓存完成^_^');
})->describe('缓存今日登录玩家数据');

Artisan::command('1000y:init:item', function () {
    $dir = config('database.sdb.tgs.init');
    $file = 'Item.sdb';
    $csv = new \ParseCsv\Csv();
    $csv->encoding('GBK', 'UTF-8');
    $csv->auto($dir.$file);
    $data = $csv->data;
    $this->info('开始缓存游戏物品数据(共'.count($data).'种)！');
    Cache::forever('1000yItems', json_encode($data));
    //$bar = $this->output->createProgressBar(count($data));
    foreach ($data as $item) {
        //$this->performTask($user);
        Cache::forever('1000yItem:'.$item['Name'], json_encode($item));
        //$bar->advance();
    }
    //$bar->finish();
    $this->info('游戏物品数据缓存完成^_^');
})->describe('缓存游戏物品数据表item.sdb');


Artisan::command('1000y:init:monster', function () {
    $dir = config('database.sdb.tgs.init');
    $file = 'Monster.sdb';
    $csv = new \ParseCsv\Csv();
    $csv->encoding('GBK', 'UTF-8');
    $csv->auto($dir.$file);
    $data = $csv->data;
    $this->info('开始缓存游戏怪物数据(共'.count($data).'种)！');
    Cache::forever('1000yMonsters', json_encode($data));
    //$bar = $this->output->createProgressBar(count($data));
    foreach ($data as $monster) {
        //$this->performTask($user);
        Cache::forever('1000yMonster:'.$monster['Name'], json_encode($monster));
        //$bar->advance();
    }
    //$bar->finish();
    $this->info('游戏怪物数据缓存完成^_^');
})->describe('缓存游戏怪物数据表monster.sdb');

Artisan::command('1000y:cache', function () {
    $this->info('开始缓存游戏数据');
    $this->call('1000y:users');
    $this->call('1000y:init:item');
    $this->call('1000y:init:monster');
    $this->info('游戏数据缓存完成^_^');
})->describe('缓存游戏数据');

Artisan::command('1000y:sms {mobile : 玩家手机号码} {password : 玩家账号密码}', function () {
    $mobile = $this->argument('mobile');
    $password = $this->argument('password');
    if ($this->confirm('确定发送短信吗？')) {
        $easySms = app('easysms');
        try {
            $easySms->send($mobile, [
                'template' => 'SMS_144942084',
                'data' => [
                    'password' => $password,
                ],
            ]);
            $this->info('短信发送成功 ^_^');
        } catch (\Exception $exception) {
            // dd($exception->getExceptions());
            $this->error('出错啦，短信发送未遂 T_T');
        }
    } else {
        $this->comment('恭喜你，又省了一条短信费用 ^_^');
    }
})->describe('给指定手机发送密码短信');
