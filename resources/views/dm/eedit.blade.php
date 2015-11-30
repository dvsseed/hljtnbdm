@extends('master')

@section('title')
    建案清单-改
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>建案清单 / 改</h3>
                    </div>
                    @include('errors.list')
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'dm_uupdate', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form', 'data-toggle' => 'validator')) !!}
                        <div class="form-group">
                            {!! Form::label('id', '#: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('id', $buildcase->id, ['class' => 'form-control', 'readonly', 'placeholder' => '系统自动产生编号']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('doctor', '建案人: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('doctor', \App\User::find($buildcase->doctor)->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('personid', '身份证: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('personid', $buildcase->personid, ['class' => 'form-control', 'pattern' =>'^[_A-z0-9]{1,}$', 'maxlength' => '18', 'data-minlength' => '18', 'data-minlength-error' => '输入文字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('cardid', '卡号: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('cardid', $buildcase->cardid, ['class' => 'form-control', 'pattern' =>'^[0-9]{1,}$', 'maxlength' => '8', 'data-minlength' => '1', 'data-minlength-error' => '输入数字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('duty', '主卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('duty', $dutys, $buildcase->duty, ['class' => 'form-control', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('nurse', '护理卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('nurse', $nurses, $buildcase->nurse, ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('dietitian', '营养卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('dietitian', $dietitians, $buildcase->dietitian, ['class' => 'form-control']) !!}
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
