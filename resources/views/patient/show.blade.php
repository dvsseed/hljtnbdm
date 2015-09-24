@extends('layout')

@section('content')
    <div class="page-header">
        <h3>病患基本数据 / 查 </h3>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form action="#" class="form-horizontal" role="form">
                <div class="form-group">
                     <label for="nome" class="col-md-2 control-label">#</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->id}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_patientid}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_personid" class="col-md-2 control-label">身份证号</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_personid}}</div>
                </div>
                <div class="form-group">
                     <label for="account" class="col-md-2 control-label">登入帐号</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->account}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_name" class="col-md-2 control-label">姓名</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_name}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_birthday" class="col-md-2 control-label">生日</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_birthday}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_sex" class="col-md-2 control-label">性别</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_sex ? "男" : "女"}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_height}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_weight}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_tel1}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_tel2}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_mobile1}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_mobile2}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_address" class="col-md-2 control-label">联络地址</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_address}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_email" class="col-md-2 control-label">电子邮件</label>
                     <div class="col-md-10 form-control-static">{{$patientprofile->pp_email}}</div>
                </div>

            </form>

            <a class="btn btn-default" href="{{ route('patient.index') }}">返回</a>
            <a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a>
            <form action="#/$patientprofile->id" method="DELETE" style="display: inline;" onsubmit="if(confirm('确定删除?')) { return true } else {return false };"><button class="btn btn-danger" type="submit">删</button></form>
        </div>
    </div>

@endsection
