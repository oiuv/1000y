@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@endsection

@section('content')

    <div class="container mt-3">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">

                <div class="card-header">
                    <h2 class="text-center">
                        <i class="fa fa-edit"></i>
                        @if($topic->id)
                            编辑话题
                        @else
                            新建话题
                        @endif
                    </h2>
                </div>

                @include('common.error')
                @if(Auth::user()->lastdate && Auth::user()->lastdate != '未登录')
                    <div class="card-body">
                        @if($topic->id)
                            <form action="{{ route('topics.update', $topic->id) }}" method="POST"
                                  accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="title"
                                                   value="{{ old('title', $topic->title ) }}" placeholder="请填写标题"
                                                   required/>
                                        </div>

                                        <div class="form-group">
                                            <select title="文章分类" class="form-control" name="category_id" required>
                                                <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>
                                                    请选择分类
                                                </option>
                                                @foreach ($categories as $value)
                                                    <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="body" class="form-control" id="editor" rows="3"
                                                      placeholder="请填入至少三个字符的内容。"
                                                      required>{{ old('body', $topic->body ) }}</textarea>
                                        </div>

                                        <div class="well well-sm">
                                            <button type="submit" class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存
                                            </button>
                                        </div>
                                    </form>
                    </div>
                @else
                    <div class="m-5 alert bg-dark text-light text-sm-center">
                        你还没登录过游戏，禁止发帖 T_T
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(document).ready(function () {
            let editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('topics.upload_image') }}',
                    params: {_token: '{{ csrf_token() }}'},
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>

@stop