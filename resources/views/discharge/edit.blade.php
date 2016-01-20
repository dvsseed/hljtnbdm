@extends('master')

@section('title')
    出院指导-改
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
            <form id="dischargeform" action="{{ route('discharge.update', $discharge->id) }}" method="POST" role="form" data-toggle="validator">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="di_patientname">患者名</label>
                    <input type="text" name="di_patientname" id="di_patientname" class="input-sm" size="5" value="{{ $ppname }}" style="background-color: lightgray !important" readonly>
                    <label class="control-label" for="di_patientid">患者ID</label>
                    <input type="text" name="di_patientid" id="di_patientid" class="input-sm" value="{{ $patientid }}" style="background-color: lightgray !important" readonly>
                    <label class="control-label" for="discharge_at">出院日</label>
                    <input type="text" name="discharge_at" id="discharge_at" class="input-sm datepicker" size="8" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $discharge->discharge_at }}">
                    <label class="control-label" for="di_doctor">医生</label>
                    <input type="text" name="di_doctor" id="di_doctor" class="input-sm" size="5" value="{{ \App\User::find($discharge->doctor)->name }}" style="background-color: lightgray !important" readonly>
                    <label class='control-label' for="residencies">主治医生</label>
                    {!! Form::select('residencies', $residencies, $discharge->residencies, ['class' => 'input-sm']) !!}
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
                                <script id="container" name="instruction" type="text/plain" style="width:100%; height:600px">{!! $discharge->instruction !!}</script>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- a class="btn btn-default" href="{{-- route('discharge.index') --}}">返回</a -->
                <a class="btn btn-info" href="{{ route('discharge.index') }}">历史纪录</a>
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
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
