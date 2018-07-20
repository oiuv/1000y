<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'   => ['required', 'between:5,15', 'regex:/^[A-Za-z0-9\-\_]+$/', 'unique:sqlsrv.account1000y,account'],
            'email'  => 'required|email|unique:sqlsrv.account1000y',
            'mobile' => ['required', 'regex:/^1[3-9]\d{9}$/', 'unique:sqlsrv.account1000y,telephone'],
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => '验证码 不正确。',
            'name.regex'      => '用户名 只支持英文和数字。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'account'   => $data['name'],
            'telephone' => $data['mobile'],
            'email'    => $data['email'],
        ]);
    }
}
