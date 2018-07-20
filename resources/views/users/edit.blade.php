@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card col-md-10 col-md-offset-1">
            <div class="card-header my-1">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                </h4>
            </div>
            @include('common.error')
            <div class="card-body">
                {{--{{dd($user)}}--}}
                <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf

                    <div class="form-group">
                        <label for="name-field">游戏账号：</label>
                        <input class="form-control" readonly type="text" name="account" id="name-field"
                               value="{{ old('account', trim($user->account)) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="mobile-field">手 机</label>
                        <input class="form-control" readonly type="number" name="telephone" id="mobile-field"
                               value="{{ old('telephone', $user->telephone) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input class="form-control" type="text" name="email" id="email-field"
                               value="{{ old('email', $user->email) }}"/>
                    </div>

                    <div class="form-group">
                        <label for="password0">登录密码：</label>
                        <input id='password0' type="password" name="password0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">新密码：(不修改密码可不填)</label>
                        <input id='password' type="password" name="password" class="form-control"
                               value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="form-control" value="{{ old('password_confirmation') }}">
                    </div>
                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control"
                                  rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="avatar-label">用户头像</label>
                        <input type="file" name="avatar">

                        @if($user->avatar)
                            <br>
                            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200"/>
                        @endif
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection