@extends('layouts.app')

@section('title', '游戏物品大全')

@section('content')
    <button type="button" class="btn btn-info btn-block my-3">云端千年游戏物品大全</button>
    @if($cache)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>物品</th>
                <th>物品名称</th>
                <th style="width: 30%">物品说明</th>
                <th>可染色</th>
                <th>可升级</th>
                <th>合成</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cache as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <img src={{asset('sdb/items/'.$item['Shape'])}} alt="{{$item['ViewName']}}">
                    </td>
                    <td>{{$item['ViewName']}}</td>
                    <td>{!!$item['Desc']!!}</td>
                    <td>{{$item['boColoring']}}</td>
                    <td>{{$item['boUpgrade']}}</td>
                    <td>{{$item['Material']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
