<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function root()
    {
        $app = app();
        dd($app->getLoadedProviders());
        return view('pages.root');
    }

    public function permissionDenied()
    {
        // 如果当前用户有权限访问后台，直接跳转访问
        if (Auth::id()) {
            Auth::guard('admin')->loginUsingId(Auth::id());
            return redirect(url(config('admin.route.prefix')), 302);
        }
        // 否则使用视图
        abort('403','你无权访问，请登录管理员账号～');
    }
}
