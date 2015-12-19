@extends('master')

@section('title')
    修改个人信息
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/dm/personal">
                            <button class="btn btn-info">个人信息</button>
                        </a>
                    </div>
                    @include('errors.list')
                    <div class="panel-body">
                        {!! Form::open(['url' => '/dm/update', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('id', '#: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('id', Auth::user()->id, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('account', '帐号: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('account', Auth::user()->account, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', '密码: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('password', '', ['class' => 'form-control', 'required', 'placeholder' => '请输入密码']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', '姓名: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('department', '部门: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('department', Auth::user()->department, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('position', '职务: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('position', Auth::user()->position, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', '手机: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('phone', Auth::user()->phone, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', '邮箱: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="group">
                            <a class="btn btn-default" href="{{ route('dm_personal') }}">返回</a>
                            {!! Form::submit('确认修改', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    $(function(){
    $("#email").completer({
    separator: "@",
    source: ["126.com", "163.com", "yeah.net", "qq.com", "gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "live.com", "aol.com", "mail.com"]
    });
    });
@stop
