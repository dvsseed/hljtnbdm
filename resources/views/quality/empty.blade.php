@extends('master')

@section('title')
    统计报表
@stop

@section('activeq1')
active
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('errors.list')
        <a class="btn btn-default" href="{{ route('quality.index') }}">返回</a>
        <h1>没有资料...</h1>
    </div>
</div>
@stop
