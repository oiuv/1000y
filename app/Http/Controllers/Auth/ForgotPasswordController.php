<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\YhUser;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // 验证账号和邮箱
        $request->validate([
            'account' => 'required|string',
            'email' => 'required|email',
        ]);

        // 检查账号和邮箱是否匹配
        $user = User::where('account', $request->account)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()
                ->withInput($request->only('account', 'email'))
                ->withErrors(['account' => '账号和邮箱不匹配']);
        }

        // 移除激活限制，允许未激活的账号找回密码

        // 发送密码重置链接
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
