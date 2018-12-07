<nav class="navbar navbar-expand-md navbar-dark navbar-static-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.gif') }}" alt="{{ config('app.name', 'Laravel') }}" class="img-responsive">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link {{ active_class(if_route('root')) }}"
                                        href="{{ route('root') }}">首页</a></li>
                <li class="nav-item"><a class="nav-link {{ active_class(if_route('topics.index')) }}"
                                        href="{{ route('topics.index') }}">话题</a></li>
                <li class="nav-item"><a
                            class="nav-link {{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}"
                            href="{{ route('categories.show', 1) }}">分享</a></li>
                <li class="nav-item"><a
                            class="nav-link {{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}"
                            href="{{ route('categories.show', 2) }}">问答</a></li>
                <li class="nav-item"><a
                            class="nav-link {{ active_class((if_route('categories.show') && if_route_param('category', 3))) }}"
                            href="{{ route('categories.show', 3) }}">反馈</a></li>
                <li class="nav-item"><a
                            class="nav-link {{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}"
                            href="{{ route('categories.show', 4) }}">公告</a></li>
                <li class="nav-item"><a class="nav-link {{ active_class(if_route('download')) }}"
                                        href="{{ route('download') }}">下载</a></li>
                <li class="nav-item"><a class="nav-link {{ active_class((if_route('sdb.index') && if_route_param('name', 'items'))) }}" href="{{ route('sdb.index','items') }}">物品</a></li>
                <li class="nav-item"><a class="nav-link {{ active_class((if_route('sdb.index') && if_route_param('name', 'monsters'))) }}" href="{{ route('sdb.index','monsters') }}">怪物</a></li>
                <li class="nav-item"><a class="nav-link {{ active_class((if_route('sdb.index') && if_route_param('name', 'users'))) }}" href="{{ route('sdb.index','users') }}">玩家</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item mx-1">
                        <a class="nav-link btn btn-sm btn-outline-secondary" href="{{ route('login') }}"><i class="fa fa-fw fa-user"></i> {{ __('Login') }}</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link btn btn-sm btn-outline-secondary" href="{{ route('register') }}"><i class="fa fa-fw fa-user-plus"></i> {{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('topics.create') }}">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>
                    </li>
                    {{-- 消息通知标记 --}}
                    <li class="nav-item">
                        <a href="{{ route('notifications.index') }}" class="notifications-badge nav-link">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} badge-pill"
                                  title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-responsive rounded-circle mr-1" src="{{ Auth::user()->avatar }}"
                                 height="30px" width="30px">{{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('manage_contents')
                                <a class="dropdown-item" href="{{ route('permission-denied') }}">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>管理后台
                                </a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}"><i class="fa fa-user fa-fw"
                                                                                                     aria-hidden="true"></i>个人中心</a>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}"><i
                                        class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>编辑资料</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
