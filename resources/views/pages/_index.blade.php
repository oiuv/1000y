<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron my-1 py-2">
                <h1 class="display-6">{{config('app.name', '云端千年')}}-公告栏</h1>
                <p class="lead" style="text-indent: 2em">本站基于Laravel框架开发，主要用于技术研究，代码开源。本站提供游戏技术演示和玩家游戏体验，游戏完全免费。</p>

                <div class="alert alert-info">
                    <h5>开源项目地址：</h5>
                    <ul class="mb-0">
                        <li><a href="https://github.com/oiuv/1000y" target="_blank">云端网站源码：https://github.com/oiuv/1000y</a></li>
                        <li><a href="https://github.com/oiuv/TGS1000" target="_blank">炎黄TGS源码：https://github.com/oiuv/TGS1000</a></li>
                        <li><a href="https://github.com/oiuv/1000yPascal" target="_blank">游戏开发文档：https://github.com/oiuv/1000yPascal</a></li>
                    </ul>
                </div>

                <div class="alert alert-success">
    千年游戏开发交流QQ群：2887111<br>
    <small class="text-muted">群内可下载游戏服务端，自己架设游戏</small>
</div>

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
