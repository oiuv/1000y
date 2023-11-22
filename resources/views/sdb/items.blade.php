@extends('layouts.app')

@section('title', '游戏物品大全')

@section('content')
    <button type="button" class="btn btn-info btn-block my-3">{{config('app.name', '云端千年')}}游戏物品大全</button>
    @if(isset($cache))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>物品</th>
                <th>物品名称</th>
                <th style="width: 30%">物品说明</th>
                <th>价格</th>
                <th>合成</th>
                <th>Kind</th>
                <th>WS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cache as $item)
                @if(count($item) > 70 && $item['Kind'])
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <img src={{asset('img/items/'.$item['Shape'].'.jpg')}} alt="{{$item['ViewName']}}"
                                 data-toggle="tooltip" data-html="true"
                                 title="
<div class='text-left'>
<div class='py-3 px-3'>
<img src={{asset('sdb/items/'.$item['Shape'])}}>{{$item['ViewName']}}
</div>
<div class='mx-3'>
<div>{!!$item['Desc']!!}</div>
<div>{{$item['AttackSpeed']?'攻击速度：'.$item['AttackSpeed']:''}}</div>
@if($item['DamageBody']||$item['DamageHead']||$item['DamageArm']||$item['DamageLeg'])
<div>破坏力：{{$item['DamageBody']?:0}}/{{$item['DamageHead']?:0}}/{{$item['DamageArm']?:0}}/{{$item['DamageLeg']?:0}}</div>
@endif
<div>{{$item['Recovery']?'恢复：'.$item['Recovery']:''}} {{$item['Avoid']?'躲闪：'.$item['Avoid']:''}}</div>
<div>{{$item['Accuracy']?'准确度：'.$item['Accuracy']:''}} {{$item['KeepRecovery']?'姿势维持：'.$item['KeepRecovery']:''}}</div>
@if($item['ArmorBody']||$item['ArmorHead']||$item['ArmorArm']||$item['ArmorLeg'])
<div>防御力：{{$item['ArmorBody']?:0}}/{{$item['ArmorHead']?:0}}/{{$item['ArmorArm']?:0}}/{{$item['ArmorLeg']?:0}}</div>
@endif
<div class='my-3'>价格：{{$item['Price']?:0}}钱币</div>
</div>
</div>
">
                        </td>
                        <td>{{$item['ViewName']}}</td>
                        <td>{!!$item['Desc']!!}</td>
                        <td>{{$item['Price']}}</td>
                        <td>{{$item['Material']}}</td>
                        <td>{{$item['Kind']}}</td>
                        <td>{{$item['WearShape']}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">数据未缓存，无法显示内容，请联系管理员。</div>
    @endif
@endsection

@section('scripts')
    <script>
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
        });
    </script>
@endsection
