@extends('master')

@section('title')
    添加功能
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>添加功能</h2>
                <hr>
                @include('errors.list')
                <div class="form-group">
                    {!! Form::model($feature = new \App\Feature, ['url' => 'feature/', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('id', '编号: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('id', null, ['class' => 'form-control', 'readonly', 'placeholder' => '系统自动编号']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('href', '方法名: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('href', old('href'), ['class' => 'form-control', 'required', 'placeholder' => '要连结的 URL 放这里']) !!}
                            </div>
                        </div>
{{--
                       	<div class="form-group">
                            {!! Form::label('btnclass', '按钮类: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                               	{ !! Form::text('btnclass', old('btnclass'), ['class' => 'form-control', 'required', 'placeholder' => 'Bootstrap按钮类']) !! }
                            </div>
                        </div>
--}}
                        <div class="form-group">
                            {!! Form::label('btnclass', '按钮类: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::select('btnclass', ['btn-default' => 'btn-default', 'btn-primary' => 'btn-primary', 'btn-success' => 'btn-success', 'btn-info' => 'btn-info', 'btn-warning' => 'btn-warning', 'btn-danger' => 'btn-danger'], old('btnclass'), ['class' => 'form-control', 'required']) !!}
                            </div>
                       	</div>
                        <div class="form-group">
                            {!! Form::label('innerhtml', '描述: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('innerhtml', old('innerhtml'), ['class' => 'form-control', 'required', 'placeholder' => '要显示的连结文字放这里']) !!}
                            </div>
                        </div>
                        <h4></h4>
                        <div class="form-group">
                            <div class="col-md-5">
                                <a class="btn btn-default" href="{{ route('feature.index') }}" role="button">返回</a>
                                {!! Form::submit('完成,创建', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @include('Admin.right_bar')
        </div>
    </div>
@stop
