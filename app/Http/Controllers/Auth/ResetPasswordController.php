<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\YhUser;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        $request->validate([
            // 'token' => 'required',
            'email' => 'required|email',
            'password' => 'between:6,11|confirmed',
        ]);
        // dd($request->all());
        $email = $request->email;
        $token = $request->token;
        $password = $request->password;
        if (Hash::check($token, PasswordReset::where('email', $email)->value('token'))) {
            // 更新神武密码
            User::where('email', $email)->update([
                'password' => $password,
            ]);
            // 更新炎黄密码
            // YhUser::where('email', $email)->update([
            //     'password' => $password,
            // ]);
            PasswordReset::where('email', $email)->delete();
            return redirect('login')->with('status', '密码修改成功,请登录!');
        } else {
            return back()->withErrors([
                'email' => ['邮箱错误或密码重置链接失效']
            ]);
        }
    }
}
