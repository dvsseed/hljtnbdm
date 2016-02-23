@extends('master')

@section('title')
    照护品质
@stop

@section('activeq1')
active
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <h2>照护品质统计</h2>
                <hr>
                @include('errors.list')
                <div class="form-group">
                    {!! Form::model($user = new \App\User, ['url' => 'quality/', 'class' => 'form-horizontal', 'role' => 'form', 'data-toggle' => 'validator']) !!}
                    <div class="form-group has-feedback">
                        {!! Form::label('object', '对象：', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
                            {!! Form::select('object', $objects, old('objects'), ['class' => 'form-control', 'required']) !!}
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div id="interval" class="form-group has-feedback" style="display: none">
                        {!! Form::label('interval', '区间日期：', ['class' => 'control-label col-md-1']) !!}
                        <div class="col-md-4">
<?php $year = 2016; ?>
                            <select class="input-sm" name="interval_fromyear">
                                <option value="-1">不详</option>
                                @for ($i = $year; $i > 2014; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>年
                            <select class="input-sm" name="interval_frommonth">
                                <option value="-1">不详</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>月 ～
                            <select class="input-sm" name="interval_toyear">
                                <option value="-1">不详</option>
                                @for ($i = $year; $i > 2014; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>年
                            <select class="input-sm" name="interval_tomonth">
                                <option value="-1">不详</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>月
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5">
                            {!! Form::submit('统计报表', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('loadScripts')
    <script>
        $(document).ready(function(){
            $('#object').on('change', function() {
                if(this.value >= 14){$('#interval:hidden').show();} else {$('#interval:visible').hide();}
            });
        });
    </script>
@stop