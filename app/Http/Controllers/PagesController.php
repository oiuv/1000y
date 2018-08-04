<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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

}
