<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            if (app()->isLocal())
                $dir = __DIR__.'/../../../../';
            else
                $dir = 'D:\1000yServer\CN-SW-DB\Userdata\\';
            if (Carbon::now()->hour > 3)
                $file = 'UserData'.date('Y-m-d').'.SDB';
            else
                $file = 'UserData'.Carbon::yesterday()->format('Y-m-d').'.SDB';
            $csv = new Csv();
            $csv->encoding('GBK', 'UTF-8');
            $csv->auto($dir.$file);
            $data = $csv->data;
            echo '<pre>';
            if ($name)
                foreach ($data as $user) {
                    if ($user['PrimaryKey'] == $name) {
                        print_r($user);
                    }
                }
            else
                print_r($data);

            echo '</pre>';
            //$data = json_encode($data);
        }
        else {
            return abort('403', '你无权访问，请登录管理员账号～');
        }
    }
}
