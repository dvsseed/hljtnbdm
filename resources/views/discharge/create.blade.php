@extends('master')

@section('title')
    出院指导-增
@stop

@section('actived')
active
@stop

@section('css')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="/laravel-u-editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/laravel-u-editor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/laravel-u-editor/lang/zh-cn/zh-cn.js"></script>
    {!! Html::style('css/discharge.css') !!}
    {{-- @include('UEditor::head'); --}}
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header hidden-print">
            <h3>出院指导 / 增</h3>
        </div>

        <div class="col-md-12">
            @include('errors.list')
            @if(is_null($err_msg))
            <form id="dischargeform" action="{{ route('discharge.store') }}" method="POST" role="form" data-toggle="validator">
                <input type="hidden" name="pp_id" value="{{ $patientprofiles->id }}">
                <input type="hidden" name="user_id" value="{{ $uid }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="di_patientname">患者名</label>
                    <input type="text" name="di_patientname" id="di_patientname" class="input-sm" size="5" value="{{ $ppname }}" style="background-color: lightgray !important" readonly>
                    <label class="control-label" for="di_patientid">患者ID</label>
                    <input type="text" name="di_patientid" id="di_patientid" class="input-sm" value="{{ $patientid }}" style="background-color: lightgray !important" readonly>
                    <label class="control-label" for="discharge_at">出院日</label>
                    <input type="text" name="discharge_at" id="discharge_at" class="input-sm datepicker" size="8" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $today }}">
                    <label class="control-label" for="di_doctor">医生</label>
                    <input type="text" name="di_doctor" id="di_doctor" class="input-sm" size="5" value="{{ Auth::user()->name }}" style="background-color: lightgray !important" readonly>
                    <label class='control-label' for="residencies">主治医生</label>
                    {!! Form::select('residencies', $residencies, old('residencies'), ['class' => 'input-sm']) !!}
                </div>
                <hr>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%">出院指导(字数限制: 2,000字)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <script id="container" name="instruction" type="text/plain" style="width:100%; height:600px"></script>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- a class="btn btn-default" href="{{-- route('discharge.index') --}}">返回</a -->
                <a class="btn btn-info" href="{{ route('discharge.index') }}">历史纪录</a>
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
            @else
                <h4></h4>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>[注意]</strong><br>{!! $err_msg !!}
                </div>
                <a class="btn btn-info" href="{{ route('discharge.index') }}">历史纪录</a>
            @endif
        </div>
    </div>
@endsection

@section('loadScripts')
    {!! Html::script('js/discharge.js') !!}
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
@stop
