<div class="card">
    <div class="card-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="fa fa-pencil" aria-hidden="true"></span> 新建帖子
        </a>
    </div>
</div>

@if (count($links))
    <div class="card">
        <div class="card-body active-users">

            <div class="text-center">资源推荐</div>
            <hr>
            @foreach ($links as $link)
                <a class="media my-1" href="{{ $link->link }}">
                    <div class="media-body">
                        <span class="media-heading">{{ $link->title }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif

@if (count($active_users))
    <div class="card">
        <div class="card-body active-users">

            <div class="text-center">活跃玩家</div>
            <hr>
            @foreach ($active_users as $active_user)
                <a class="media my-1" href="{{ route('users.show', $active_user->id) }}">
                    <div class="media-left">
                        <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="rounded-circle media-object">
                    </div>

                    <div class="media-body ml-1">
                        <span class="media-heading">{{ $active_user->name }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif

<div class="card">
    <div class="card-header text-center">
        支持云端
    </div>
    <img class="card-img-top" src="{{asset("uploads/images/alipay.png")}}" alt="Card image cap">
    <div class="card-body active-users">
        <h5 class="card-title">捐助说明</h5>
        <p class="card-text" style="text-indent: 2em">云端千年游戏免费，如果你有一定的经济能力，也欢迎扫码支持服务器运维，注意：捐助并不会在游戏中获得任何特权，仅有每捐助100元赠送随机宝石1颗感谢。</p>
        <a href="{{asset("topics/4")}}" class="btn btn-primary">历年捐助名单</a>
    </div>
</div>
