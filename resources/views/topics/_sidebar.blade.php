<div class="card">
    <div class="card-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="fa fa-pencil" aria-hidden="true"></span> 新建帖子
        </a>
    </div>
</div>

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