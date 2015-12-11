@extends('master')

@section('title')
    添加操作
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <h2>添加操作</h2>
                <hr />

                @include('errors.list')

                <div class="form-group">
                    {!! Form::model($hasfeature = new \App\Hasfeature, ['url' => 'hasfeature/', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('id', '#: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                                {!! Form::text('id', '系统自动编号', ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                       	<div class="form-group">
                            {!! Form::label('user_id', '人名: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                               	{!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('feature_id', '功能: ', ['class' => 'control-label col-md-1']) !!}
                            <div class="col-md-4">
                            @foreach ($features as $feature)
                                {!! Form::checkbox('feature_id[]', $feature->id, true, ['class' => 'form-field']) !!}
                                {{ $feature->innerhtml }}
                                <br />
                            @endforeach
                            </div>
                        </div>
                        <h4></h4>
                        <div class="form-group">
                            <div class="col-md-5">
                                <a class="btn btn-default" href="{{ route('hasfeature.index') }}" role="button">返回</a>
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
