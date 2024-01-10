<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron my-1 py-2">
                <h1 class="display-6">{{config('app.name', '云端千年')}}-公告栏</h1>
                <p class="lead" style="text-indent: 2em">云端千年网站基于Laravel框架开发，主要用于技术研究，代码开源，本站功能仅为演示用。</p>
                <p class="lead" style="text-indent: 2em">网站必须已经登录游戏并新建角色的玩家才可以发布内容，密码找回功能也必须是正式玩家（游戏中有角色）才可以。</p>
                <!-- <div class="alert alert-success">游戏官方QQ群：2887111</div> -->
                <div class="alert alert-warning">云端千年已关服，本站为技术演示。</div>
                <hr class="m-y-md">
                <!-- <p>请注意：为避免垃圾账号注册游戏账号时密码直接发送到个人手机，收到密码后请登录网站修改密码。另外请所有玩家补充邮箱账号，方便密码找回和接收网站提醒。</p> -->
                @guest
                <p class="lead text-center">
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">注册账号</a>
                </p>
                @endguest
            </div>
        </div>
        <div class="col-md-12">

        </div>
    </div>
</div>