@extends('master')

@section('title')
    修改个人信息
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/dm/home"><button class="btn btn-info">个人信息</button></a>
                </div>

                @include('errors.list')

                <div class="panel-body">
                    {!! Form::open(['url' => '/dm/update', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('id', '编号: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('id', Auth::user()->id, ['class' => 'form-control', 'readonly'])!!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', '姓名: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'readonly'])!!}
                            </div>
                        </div>
{{--
                        <div class="form-group">
                            {!! Form::label('sex', '性别: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('sex', ['男' => '男', '女' => '女'], Auth::user()->sex, ['class' => 'form-control']) !!}
                            </div>
                        </div>
--}}
                        <div class="form-group">
                            {!! Form::label('password', '密码: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('department', '部门: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('department', Auth::user()->department, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('position', '职务: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('position', Auth::user()->position, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', '手机: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', '邮箱: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="group">
                            {!! Form::submit('确认修改', ['class' => 'btn btn-success form-control']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#email").completer({
            separator: "@",
            source: ["126.com", "163.com", "yeah.net", "qq.com", "gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "live.com", "aol.com", "mail.com"]
        });
    });
</script>
@stop
