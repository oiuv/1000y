@extends('layouts.app')

@section('title','我的通知')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">

                <div class="card-body">

                    <h3 class="text-center">
                        <span class="fa fa-bell" aria-hidden="true"></span> 我的通知
                    </h3>
                    <hr>

                    @if ($notifications->count())

                        <div class="notification-list">
                            @foreach ($notifications as $notification)
                                @include('notifications.types._' . snake_case(class_basename($notification->type)))
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>

                    @else
                        <div class="empty-block">没有消息通知！</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection