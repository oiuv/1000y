<div class="reply-list">
    @foreach ($replies as $index => $reply)
        <div class="media" id="reply{{ $reply->id }}">
            <div class="avatar media-left">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                    <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}"  style="width:48px;height:48px;"/>
                </a>
            </div>

            <div class="infos media-body mx-2">
                <div class="media-heading">
                    <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
                        {{ $reply->user->name }}
                    </a>
                    <span> •  </span>
                    <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                    {{-- 回复删除按钮 --}}
                    @can('destroy', $reply)
                    <div class="meta pull-right">
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-light btn-sm pull-left">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
                <div class="reply-content">
                    {!! $reply->content !!}
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>