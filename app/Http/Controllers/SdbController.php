<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class SdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {

        if (View::exists('sdb.'.$name)) {
            try {
                $cache = cache('1000y'.title_case($name));
                if (is_null($cache)) {
                    $exitCode = Artisan::call('1000y:cache');
                    return view('sdb.'.$name);
                } else {
                    $cache = json_decode($cache, true);
                    // 玩家元气排行榜
                    if ($name === 'users')
                        $cache = array_values(array_rsort($cache, function ($value) {
                            return $value['Energy'];
                        }));
                    return view('sdb.'.$name, ['cache' => $cache]);
                }
            } catch (\Exception $exception) {
                return abort(503, $exception->getMessage());
            }
        } else
            return abort(404, '……');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {
        $pic = $id;
        if ($name === 'items') {
            $x = $id % 5 ?: 5;
            if ($id % 5) {
                $y = (intval($id / 5) + 1) % 6 ?: 6;
            } else
                $y = intval($id / 5) % 6 ?: 6;
            if ($id % 30)
                $id = intval($id / 30) * 30 + 1;
            else
                $id = intval($id / 30) * 30 - 29;
            if (file_exists(public_path("uploads/images/$name/$id.png"))) {
                $img = Image::make(public_path("uploads/images/$name/$id.png"))->resize(167, 204);
                $img->crop(30, 32, 4 + ($x - 1) * 32, 6 + ($y - 1) * 31);
                $img->save(public_path('img/items/'.$pic.'.jpg'));
                return $img->response('jpg');
            }
            return response("{'message':'物品ID不存在','errcode':'404'}");

        } elseif ($name === 'UserData' && Auth::check() && Auth::user()->hasRole('Founder')) {
            try {
                dd(json_decode(cache('1000yUser:'.$id), true));
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } elseif ($name === 'item') {
            try {
                dd(json_decode(cache('1000yItem:'.$id), true));
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } elseif ($name === 'monster') {
            try {
                dd(json_decode(cache('1000yMonster:'.$id), true));
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } elseif ($name === 'Cache' && Auth::check() && Auth::user()->hasRole('Founder')) {
            switch ($id) {
                case 'all':
                    // Artisan::queue('1000y:cache');
                    $exitCode = Artisan::call('1000y:cache');
                    if ($exitCode) {
                        return redirect()->route('root')->with('danger', '游戏数据缓存失败！');
                    } else {
                        return redirect()->route('root')->with('success', '游戏数据缓存成功！');
                    }
                case 'users':
                    $exitCode = Artisan::call('1000y:users');
                    if ($exitCode) {
                        return redirect()->route('root')->with('danger', '玩家数据缓存失败！');
                    } else {
                        return redirect()->route('root')->with('success', '玩家数据缓存成功！');
                    }
                case 'item':
                    $exitCode = Artisan::call('1000y:init:item');
                    if ($exitCode) {
                        return redirect()->route('root')->with('danger', '物品数据缓存失败！');
                    } else {
                        return redirect()->route('root')->with('success', '物品数据缓存成功！');
                    }
                case 'monster':
                    $exitCode = Artisan::call('1000y:init:monster');
                    if ($exitCode) {
                        return redirect()->route('root')->with('danger', '怪物数据缓存失败！');
                    } else {
                        return redirect()->route('root')->with('success', '怪物数据缓存成功！');
                    }
                default:
                    return response("{'message':'无效参数','errcode':'404'}");
            }
        }

        return response("{'message':'数据未找到或无权查询','errcode':'404'}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
