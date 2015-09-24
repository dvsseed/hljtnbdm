@extends('layout')

@section('content')
    <div class="page-header">
        <h3>病患基本数据 / 改</h3>
    </div>

    <div class="row">
        <div class="col-md-12">

            @include('errors.list')

            <form action="{{ route('patient.update', $patientprofile->id) }}" method="POST" class="form-horizontal" role="form">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="nome" class="col-md-2 control-label">#</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->id }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>
                     <div class="col-md-10"><input type="text" name="pp_patientid" class="form-control" value="{{ $patientprofile->pp_patientid }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_personid" class="col-md-2 control-label">身份证号</label>
                     <div class="col-md-10"><input type="text" name="pp_personid" class="form-control" value="{{ $patientprofile->pp_personid }}"/></div>
                </div>
                <div class="form-group">
                     <label for="account" class="col-md-2 control-label">登入帐号</label>
                     <div class="col-md-10"><input type="text" name="account" class="form-control" value="{{ $patientprofile->account }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_name" class="col-md-2 control-label">姓名</label>
                     <div class="col-md-10"><input type="text" name="pp_name" class="form-control" value="{{ $patientprofile->pp_name }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_birthday" class="col-md-2 control-label">生日</label>
                     <div class="col-md-10"><input type="text" name="pp_birthday" id="pp_birthday" class="form-control datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $patientprofile->pp_birthday }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_sex" class="col-md-2 control-label">性别</label>
                     <div class="col-md-10"><select name="pp_sex" class="form-control"><option value="0" {{$patientprofile->pp_sex ? "selected='selected'" : ""}}>女</option><option value="1" {{$patientprofile->pp_sex ? "selected='selected'" : ""}}>男</option></select></div>
                </div>
                <div class="form-group">
                     <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>
                     <div class="col-md-10"><input type="text" name="pp_height" class="form-control" value="{{ $patientprofile->pp_height }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>
                     <div class="col-md-10"><input type="text" name="pp_weight" class="form-control" value="{{ $patientprofile->pp_weight }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>
                     <div class="col-md-10"><input type="text" name="pp_tel1" class="form-control" value="{{ $patientprofile->pp_tel1 }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>
                     <div class="col-md-10"><input type="text" name="pp_tel2" class="form-control" value="{{ $patientprofile->pp_tel2 }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>
                     <div class="col-md-10"><input type="text" name="pp_mobile1" class="form-control" value="{{ $patientprofile->pp_mobile1 }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>
                     <div class="col-md-10"><input type="text" name="pp_mobile2" class="form-control" value="{{ $patientprofile->pp_mobile2 }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_address" class="col-md-2 control-label">联络地址</label>
                     <div class="col-md-10"><input type="text" name="pp_address" class="form-control" value="{{ $patientprofile->pp_address }}"/></div>
                </div>
                <div class="form-group">
                     <label for="pp_email" class="col-md-2 control-label">电子邮件</label>
                     <div class="col-md-10"><input type="text" name="pp_email" id="pp_email" class="form-control" value="{{ $patientprofile->pp_email }}"/></div>
                </div>

                <a class="btn btn-default" href="{{ route('patient.index') }}">返回</a>
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
$(function () {
    $("#pp_birthday").datepicker();

    $("#pp_email").completer({
        separator: "@",
        source: ["126.com", "163.com", "yeah.net", "qq.com", "gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "live.com", "aol.com", "mail.com"]
    });

});
@stop

