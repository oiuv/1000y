<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => ['required','email',
                Rule::unique('sqlsrv.account1000y')->ignore(Auth::id())],
            'password0' => 'required|exists:sqlsrv.account1000y,password',
            'password' => 'nullable|confirmed|min:6',
            'introduction' => 'max:80',
            'avatar'       => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes'      => '头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
            'name.regex'        => '用户名只支持英文、数字、横杆和下划线。',
            'password.min'      => '新密码 至少6个字符',
            'password0.required' => '登录密码 不能为空。',
            'password0.exists'   => '登录密码 不正确。',
        ];
    }
}
