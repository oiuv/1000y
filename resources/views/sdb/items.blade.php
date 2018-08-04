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
                <th>价格</th>
                <th>合成</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cache as $item)
                @if($item['Kind'])
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <img src={{asset('sdb/items/'.$item['Shape'])}} alt="{{$item['ViewName']}}">
                        </td>
                        <td>{{$item['ViewName']}}</td>
                        <td>{!!$item['Desc']!!}</td>
                        <td>{{$item['Price']}}</td>
                        <td>{{$item['Material']}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
