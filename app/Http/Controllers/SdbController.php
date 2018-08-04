<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($name === 'items') {
            $x = $id % 5 ?: 5;
            if ($id % 5) {
                $y = (intval($id / 5) + 1) % 6 ?: 6;
            }
            else
                $y = intval($id / 5) % 6 ?: 6;
            if ($id % 30)

                $id = intval($id / 30) * 30 + 1;
            else
                $id = intval($id / 30) * 30 - 29;
            if (file_exists(public_path("uploads/images/$name/$id.png"))) {
                $img = Image::make(public_path("uploads/images/$name/$id.png"));
                $img->crop(30, 32, 4 + ($x - 1) * 32, 6 + ($y - 1) * 31);

                return $img->response('jpg');
            }
            return response("{'message':'物品ID不存在','errcode':'404'}");

        }
        elseif ($name === 'UserData' & Auth::id() == 1) {
            if ($id === 'Artisan') {
                // Artisan::queue('1000y:user');
                $exitCode = Artisan::call('1000y:user');
                if ($exitCode) {
                    return redirect()->route('root')->with('danger', '玩家数据缓存失败！');
                }
                else
                    return redirect()->route('root')->with('success', '玩家数据缓存成功！');
            }
            else {
                try {
                    dd(json_decode(cache('1000yUser:'.$id), true));
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
            }
        }

        return response("{'message':'数据未找到','errcode':'404'}");
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
