@extends('layouts.app')

@section('content')
    <div class="container mt-lg-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-exclamation-triangle"></i>
                            页面不存在
                        </h4>
                    </div>

                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-file-alt" style="font-size: 4rem; color: #6c757d;"></i>
                        </div>

                        <h3 class="text-muted mb-3">抱歉，您要查找的页面不存在</h3>

                        <p class="text-muted mb-4">
                            可能的原因：
                        </p>

                        <div class="row text-left mb-4">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-times-circle text-danger"></i> 页面已被删除</li>
                                    <li><i class="fas fa-times-circle text-danger"></i> URL输入错误</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-times-circle text-danger"></i> 链接已失效</li>
                                    <li><i class="fas fa-times-circle text-danger"></i> 您没有访问权限</li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('root') }}" class="btn btn-primary">
                                <i class="fas fa-home"></i> 返回首页
                            </a>
                            <a href="{{ route('topics.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> 浏览帖子
                            </a>
                            @if(auth()->check())
                            <a href="{{ route('topics.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> 发布新帖
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer text-muted text-center">
                        <small>
                            如果您认为这是系统错误，请联系管理员或
                            <a href="{{ route('topics.index') }}">浏览其他帖子</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection