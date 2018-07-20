<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel')) - Laravel 进阶教程</title>
    <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区')"/>
    <meta name="keyword" content="@yield('keyword', 'LaraBBS,社区,论坛,开发者论坛')"/>

    <!-- Styles -->
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    @yield('card')

    <div class="container">
        @include('layouts._message')
        @yield('content')

    </div>

    @include('layouts._footer')
</div>
@if (app()->isLocal())
    @include('sudosu::user-selector')
@endif
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>