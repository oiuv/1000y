@extends('layouts.app')

@section('content')
    <div class="container mt-lg-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">暂停服务</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ $exception->getMessage() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection