@extends('master')

@section('title')
    添加人员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>添加人员</h2>
                <hr />

                @include('errors.list')

                <div class="form-group">
                    {!! Form::model($user = new \App\User, ['url' => 'admin/', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('id', '编号: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('id', old('id'), ['class' => 'form-control', 'required', 'placeholder' => 'HIS编号']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', '姓名: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('pwd', '密码: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('pwd', null, ['class' => 'form-control', 'readonly', 'placeholder' => '默认为编号']) !!}
                            </div>
                        </div>
                        <h4></h4>
                        <div class="form-group">
                            <div class="col-md-5">
                                {!! Form::submit('完成,创建', ['class' => 'btn btn-success form-control']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @include('Admin.right_bar')
        </div>
    </div>
@stop
