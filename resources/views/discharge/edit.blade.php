@extends('master')

@section('title')
    出院指导-改
@stop

@section('activec')
    <li class=""><a href="/patient">患者资料</a></li>
    <li class=""><a href="/bdata/">血糖</a></li>
    <li class=""><a href="/case">方案</a></li>
    <li class="active"><a href="/discharge">出院指导</a></li>
@stop

@section('css')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="/laravel-u-editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/laravel-u-editor/ueditor.all.min.js"> </script>
    <!-- 建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败 -->
    <!-- 这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文 -->
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
                    <input type="text" name="di_patientname" id="di_patientname" class="input-sm" size="5" value="{{ $ppname }}" readonly>
                    <label class="control-label" for="di_patientid">患者ID</label>
                    <input type="text" name="di_patientid" id="di_patientid" class="input-sm" value="{{ $patientid }}" readonly>
                    <label class="control-label" for="discharge_at">出院日</label>
                    <input type="text" name="discharge_at" id="discharge_at" class="input-sm datepicker" size="8" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $discharge->discharge_at }}">
                    <label class="control-label" for="di_doctor">医生</label>
                    <input type="text" name="di_doctor" id="di_doctor" class="input-sm" size="5" value="{{ \App\User::find($discharge->doctor)->name }}" readonly>
                    <label class='control-label' for="residencies">住院医生</label>
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
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="instruction" type="text/plain" style="width:100%; height:600px">{!! $discharge->instruction !!}</script>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- a class="btn btn-default" href="{{-- route('discharge.index') --}}">返回</a -->
                <a class="btn btn-info" href="{{ route('discharge.index') }}">历史纪录</a>
                <button class="btn btn-primary" type="submit">保存</button>
                <!-- button class="btn btn-default" type="button" onclick="printdiv()">打印</button -->
            </form>
        </div>
    </div>
@endsection

@section('loadScripts')
    {!! Html::script('js/discharge.js') !!}
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
@stop
