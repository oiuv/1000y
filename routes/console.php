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

Artisan::command('1000y:user', function () {
    if (app()->isLocal())
        $dir = __DIR__.'/../../';
    else
        $dir = 'D:\1000yServer\CN-SW-DB\Userdata\\';
    if (Carbon::now()->hour > 3)
        $file = 'UserData'.date('Y-m-d').'.SDB';
    else
        $file = 'UserData'.Carbon::yesterday()->format('Y-m-d').'.SDB';
    $csv = new \ParseCsv\Csv();
    $csv->encoding('GBK', 'UTF-8');
    $csv->auto($dir.$file);
    $data = $csv->data;
    $this->info('开始缓存玩家数据(共'.count($data).'人)！');
    //$bar = $this->output->createProgressBar(count($data));
    foreach ($data as $user) {
        //$this->performTask($user);
        Cache::forever('1000yUser:'.$user['PrimaryKey'], json_encode($user));
        //$bar->advance();

    }
    //$bar->finish();

    $this->info('玩家数据缓存完成^_^');
})->describe('缓存今日登录玩家数据');