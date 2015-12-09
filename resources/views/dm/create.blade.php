@extends('master')

@section('title')
    建案清单-增
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>建案清单 / 增</h3>
                    </div>
                    @include('errors.list')
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'dm_store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form', 'data-toggle' => 'validator')) !!}
                        <div class="form-group">
                            {!! Form::label('id', '#: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('id', old('id'), ['class' => 'form-control', 'readonly', 'placeholder' => '系统自动产生编号']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('doctor_name', '建案人: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('doctor_name', Auth::user()->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('personid', '身份证: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('personid', old('personid'), ['class' => 'form-control', 'pattern' => '^[_A-z0-9]{1,}$', 'maxlength' => '18', 'data-minlength' => '18', 'data-minlength-error' => '输入文字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('cardid', '卡号: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('cardid', old('cardid'), ['class' => 'form-control', 'pattern' =>'^[0-9]{1,}$', 'maxlength' => '8', 'data-minlength' => '1', 'data-minlength-error' => '输入数字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('duty', '责任卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('duty', $dutys, old('duty'), ['class' => 'form-control', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('nurse', '护理卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('nurse', $nurses, old('nurse'), ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('dietitian', '营养卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('dietitian', $dietitians, old('dietitian'), ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="group">
                            <a class="btn btn-default" href="{{ route('dm_home') }}">返回</a>
                            {!! Form::submit('确认修改', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
