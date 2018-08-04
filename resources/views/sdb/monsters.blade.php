@extends('layouts.app')

@section('title', '游戏怪物大全')

@section('content')
    <button type="button" class="btn btn-warning btn-block my-3">云端千年游戏怪物大全</button>
    @if($cache)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>生命</th>
                <th>防御</th>
                <th>攻击</th>
                <th style="width: 15%">FallItem</th>
                <th style="width: 45%">HaveItem</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cache as $item)
                @if($item['ViewName'])
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$item['ViewName']}}</td>
                        <td>{{$item['Life']}}</td>
                        <td>{{$item['Armor']}}</td>
                        <td>{{$item['Damage']}}</td>
                        <td>{{$item['FallItem']}}</td>
                        <td>{{$item['HaveItem']}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
