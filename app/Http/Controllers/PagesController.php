<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use ParseCsv\Csv;

class PagesController extends Controller
{
    public function root()
    {
        //$app = app();
        //dd($app->getLoadedProviders());
        return view('pages.root');
    }

    public function permissionDenied()
    {
        Auth::guard('admin')->logout();
        // 如果当前用户有权限访问后台，直接跳转访问
        if (Auth::id()) {
            Auth::guard('admin')->loginUsingId(Auth::id());
            return redirect(url(config('admin.route.prefix')), 302);
        }
        // 否则使用视图
        return abort('403', '你无权访问，请登录管理员账号～');
    }

    public function download()
    {
        return redirect('/topics/3');
    }

    public function account()
    {
        return redirect("users/".Auth::id());
    }

    public function activeUsers($name = null)
    {
        if (Auth::id() == 1) {
            if ($name) {
                try {
                    dd(json_decode(cache('1000yUser:'.$name), true));
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }

            }
            else {
                // Artisan::queue('1000y:user');
                $exitCode = Artisan::call('1000y:user');
                if ($exitCode) {
                    return redirect()->route('root')->with('danger', '玩家数据缓存失败！');
                }
                else
                    return redirect()->route('root')->with('success', '玩家数据缓存成功！');
            }
        }
        else {
            return abort('403', '你无权访问，请登录管理员账号～');
        }
    }
}
