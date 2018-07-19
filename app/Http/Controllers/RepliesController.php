<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->reply;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '回复成功！');
    }

    public function destroy(Reply $reply)
    {
        try {
            $this->authorize('destroy', $reply);
        } catch (AuthorizationException $authorizationException) {
            abort(403, '你无权删除此回复！');
        }

        try {
            $reply->delete();
        } catch (\Exception $exception) {
            abort(500, '删除失败T_T');
        }


        return redirect()->to($reply->topic->link())->with('success', '删除回复成功！');
    }
}