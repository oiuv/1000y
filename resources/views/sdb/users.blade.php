@extends('layouts.app')

@section('title', '玩家天梯')

@section('content')
    <button type="button" class="btn btn-success btn-block my-3">云端千年玩家天梯每日排行榜(元气境界榜)</button>
    @if($cache)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>排位</th>
                <th>角色</th>
                <th>门派</th>
                <th>职业</th>
                <th>元气境界</th>
                <th>装备(头)</th>
                <th>装备(身)</th>
                <th>装备(手)</th>
                <th>装备(脚)</th>
                <th>装备(武器)</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="10">（日榜仅统计昨日登录过游戏的角色，即将开放金钱、年龄等天梯日榜/月榜/总榜统计）</td>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cache as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['PrimaryKey']}}</td>
                    <td>{{$item['Guild']}}</td>
                    <td>@if($item['JobKind']==1) 铸造师
                        @elseif($item['JobKind']==2) 炼丹师
                        @elseif($item['JobKind']==3) 裁缝
                        @elseif($item['JobKind']==4) 工匠
                        @else
                        @endif
                    </td>
                    <td>
                        @if($item['Energy']<4000) 初入江湖
                        @elseif($item['Energy']<8000) 出入境
                        @elseif($item['Energy']<12000) 造化境
                        @elseif($item['Energy']<18000) 玄妙境
                        @elseif($item['Energy']<26000) 生死境
                        @elseif($item['Energy']<36000) 解脱境
                        @elseif($item['Energy']<48000) 无为境
                        @elseif($item['Energy']<62000) 神话境
                        @elseif($item['Energy']<78000) 无上武念
                        @elseif($item['Energy']<96000) 天人合一
                        @elseif($item['Energy']<116000) 至尊无上
                        @elseif($item['Energy']<138000) 一念通天
                        @elseif($item['Energy']<162000) 空前绝后
                        @else 泰山北斗
                        @endif
                    </td>
                    <td>{{str_before($item['WearItem1'],':')}}</td>
                    <td>{{str_before($item['WearItem3'],':')}}</td>
                    <td>{{str_before($item['WearItem5'],':')}}</td>
                    <td>{{str_before($item['WearItem6'],':')}}</td>
                    <td>{{str_before($item['WearItem7'],':')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">数据未缓存，无法显示内容，请联系管理员。</div>
    @endif
@endsection
