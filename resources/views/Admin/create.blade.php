@extends('master')

@section('title')
    添加人员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>添加人员</h2>
                <hr>
                @include('errors.list')
                <div class="form-group">
                    {!! Form::model($user = new \App\User, ['url' => 'admin/', 'class' => 'form-horizontal', 'role' => 'form',
                  'data-toggle' => 'validator']) !!}
                    <div class="form-group">
                        {!! Form::label('id', '#: ', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::text('id', old('id'), ['class' => 'form-control', 'readonly', 'placeholder' => '系统自动产生编号']) !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        {!! Form::label('account', '帐号: ', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::text('account', old('account'), ['class' => 'form-control', 'pattern' =>'^[_A-z0-9]{1,}$', 'required']) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('pwd', '密码: ', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::text('pwd', null, ['class' => 'form-control', 'readonly', 'placeholder' => '默认为帐号']) !!}
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        {!! Form::label('name', '姓名: ', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required']) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        {!! Form::label('position', '职务: ', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::select('position', ['院长' => '院长', '副院长' => '副院长', '住院处主任' => '住院处主任', '药剂科长' => '药剂科长', '病区科主任' => '病区科主任', '医师' => '医师', '医助' => '医助', '营养师' => '营养师', '护理师' => '护理师'], '营养师', ['class' => 'form-control', 'required']) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5">
                            <a class="btn btn-default" href="{{ route('admin.index') }}" role="button">返回</a>
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
