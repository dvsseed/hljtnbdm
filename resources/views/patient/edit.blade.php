@extends('layout')

@section('title')
    患者资料-改
@stop

@section('pactive')
    active
@stop

@section('css')
    {!! Html::style('css/patient.css') !!}
@stop

@section('content')
    <div class="page-header">
        <h3>病患基本数据 / 改</h3>
    </div>

    <div class="row">
        <div class="col-md-12">

            @include('errors.list')

            <form action="{{ route('patient.update', $patientprofile->id) }}" method="POST" class="form-horizontal"
                  role="form">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome" class="col-md-2 control-label">#</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->id }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>

                    <div class="col-md-10" form-control-static>{{ $patientprofile->pp_patientid }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_personid" class="col-md-2 control-label">身份证号</label>

                    <div class="col-md-10" form-control-static>{{ $patientprofile->pp_personid }}</div>
                </div>
                <div class="form-group">
                    <label for="account" class="col-md-2 control-label">登入帐号</label>

                    <div class="col-md-10" form-control-static>{{ $account }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_name" class="col-md-2 control-label">姓名</label>

                    <div class="col-md-10"><input type="text" name="pp_name" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_name }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_birthday" class="col-md-2 control-label">生日</label>

                    <div class="col-md-10"><input type="text" name="pp_birthday" id="pp_birthday"
                                                  class="form-control input-sm datepicker" data-date-format="yyyy-mm-dd"
                                                  data-date-autoclose="true" data-date-clear-btn="true"
                                                  data-date-today-highlight="true" data-date-today-btn="linked"
                                                  data-date-language="zh-TW"
                                                  value="{{ $patientprofile->pp_birthday }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_age" class="col-md-2 control-label">年龄</label>

                    <div class="col-md-10"><input type="text" name="pp_age" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_age }}"></div>
                </div>

                <div class="form-group">
                    <label for="pp_sex" class="col-md-2 control-label">性别</label>

                    <div class="col-md-10"><select name="pp_sex" class="form-control input-sm">
                            <option value="0" {{!$patientprofile->pp_sex ? "selected='selected'" : ""}}>女</option>
                            <option value="1" {{$patientprofile->pp_sex ? "selected='selected'" : ""}}>男</option>
                        </select></div>
                </div>
                <div class="form-group">
                    <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>

                    <div class="col-md-10"><input type="text" name="pp_height" id="pp_height"
                                                  class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_height }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>

                    <div class="col-md-10"><input type="text" name="pp_weight" id="pp_weight"
                                                  class="form-control input-sm" value="{{ $patientprofile->pp_weight }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>

                    <div class="col-md-10"><input type="text" name="pp_tel1" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_tel1 }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>

                    <div class="col-md-10"><input type="text" name="pp_tel2" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_tel2 }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>

                    <div class="col-md-10"><input type="text" name="pp_mobile1" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_mobile1 }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>

                    <div class="col-md-10"><input type="text" name="pp_mobile2" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_mobile2 }}"/></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_area">地区</label>

                    <div class="col-md-10">
                        <select name="pp_area" class="input-sm">
                            @foreach($areas as $key => $value)
                                <option value="{{ $key }}" {{ "$key" == $patientprofile->pp_area ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="pp_area_other" class="input-sm" value="{{ $patientprofile->pp_area_other }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_doctor">负责医生</label>

                    <div class="col-md-10">
                        <select name="pp_doctor" class="form-control input-sm">
                            @foreach($doctors as $key => $value)
                                <option value="{{ $key }}" {{ "$key" == $patientprofile->pp_doctor ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_remark" class="col-md-2 control-label">备注</label>

                    <div class="col-md-10"><input type="text" name="pp_remark" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_remark }}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_source">患者来源</label>

                    <div class="col-md-10">
                        <select name="pp_source" class="input-sm">
                            @foreach($sources as $key => $value)
                                <option value="{{ $key }}" {{ "$key" == $patientprofile->pp_source ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                            <input type="text" name="pp_source_other" class="input-sm" value="{{ $patientprofile->pp_source_other }}">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_occupation">职业</label>

                    <div class="col-md-10">
                        <select name="pp_occupation" class="input-sm">
                            @foreach($occupations as $key => $value)
                                <option value="{{ $key }}" {{ "$key" == $patientprofile->pp_occupation ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                            <input type="text" name="pp_occupation_other" class="input-sm" value="{{ $patientprofile->pp_occupation_other }}">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_address" class="col-md-2 control-label">联络地址</label>

                    <div class="col-md-10"><input type="text" name="pp_address" class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_address }}"/></div>
                </div>
                <div class="form-group">
                    <label for="pp_email" class="col-md-2 control-label">电子邮件</label>

                    <div class="col-md-10"><input type="text" name="pp_email" id="pp_email"
                                                  class="form-control input-sm"
                                                  value="{{ $patientprofile->pp_email }}"/></div>
                </div>
                <div class="form-group">
                    <label for="cc_contactor" class="col-md-2 control-label">紧急联络人</label>

                    <div class="col-md-10"><input type="text" name="cc_contactor" class="form-control input-sm"
                                                  value="{{ $casecare->cc_contactor }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_contactor_tel" class="col-md-2 control-label">紧急联络人电话</label>

                    <div class="col-md-10"><input type="text" name="cc_contactor_tel" class="form-control input-sm"
                                                  value="{{ $casecare->cc_contactor_tel }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_language" class="col-md-2 control-label">语言</label>

                    <div class="col-md-10">
                        <select name="cc_language" class="form-control input-sm">
                            @foreach($languages as $key => $value)
                                <option value="{{ $key }}" {{ "$key" == $casecare->cc_language ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mdate" class="col-md-2 control-label">诊断日期</label>

                    <div class="col-md-10">
                        发生于 西元年
                        <select name="cc_mdate" id="cc_mdate" class="input-sm">
                            <option value="-1" {{-1==$casecare->cc_mdate ? "selected='selected'" : ""}}>不详</option>
                            @for ($i = $year; $i > 1910; $i--)
                                @if ($i >= $casecare->cc_mdate)
                                    <option value="{{ $i }}" {{$i==$casecare->cc_mdate ? "selected='selected'" : ""}}>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>年
                        <select name="cc_mdatem" class="input-sm">
                            <option value="-1" {{-1==$casecare->cc_mdatem ? "selected='selected'" : ""}}>不详</option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}" {{$i==$casecare->cc_mdatem ? "selected='selected'" : ""}}>{{ $i }}</option>
                            @endfor
                        </select>月
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_type" class="col-md-2 control-label">症状型态</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_type"
                                                           id="cc_type0" {{$casecare->cc_type==0 ? "checked='checked'" : ""}}>Type1</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_type"
                                                           id="cc_type1" {{$casecare->cc_type==1 ? "checked='checked'" : ""}}>Type2</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_type"
                                                           id="cc_type2" {{$casecare->cc_type==2 ? "checked='checked'" : ""}}>GDM</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_type"
                                                           id="cc_type3" {{$casecare->cc_type==3 ? "checked='checked'" : ""}}>其它</label>
                        <input type="text" name="cc_type_other" class="input-sm" value="{{ $casecare->cc_type_other }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_ibw" class="col-md-2 control-label">IBW</label>

                    <div class="col-md-10"><input type="text" name="cc_ibw" id="cc_ibw" class="form-control input-sm"
                                                  value="{{ $casecare->cc_ibw }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_bmi" class="col-md-2 control-label">BMI</label>

                    <div class="col-md-10"><input type="text" name="cc_bmi" id="cc_bmi" class="form-control input-sm"
                                                  value="{{ $casecare->cc_bmi }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_waist" class="col-md-2 control-label">腰围</label>

                    <div class="col-md-10"><input type="text" name="cc_waist" class="input-sm"
                                                  value="{{ $casecare->cc_waist }}">公分
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_butt" class="col-md-2 control-label">臀围</label>

                    <div class="col-md-10"><input type="text" name="cc_butt" class="input-sm"
                                                  value="{{ $casecare->cc_butt }}">公分
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_status" class="col-md-2 control-label">发病状况</label>

                    <div class="col-md-10" id="ccstatus">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_status" id="cc_status0" {{empty($casecare->cc_status) ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_status" id="cc_status1" {{$casecare->cc_status ? "checked='checked'" : ""}}>有下列症状：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c1" {{substr($casecare->cc_status.'00000',0,1)=='1' ? "checked='checked'" : ""}}>口干</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c2" {{substr($casecare->cc_status.'00000',1,1)=='1' ? "checked='checked'" : ""}}>多尿</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c3" {{substr($casecare->cc_status.'00000',2,1)=='1' ? "checked='checked'" : ""}}>饥饿</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c4" {{substr($casecare->cc_status.'00000',3,1)=='1' ? "checked='checked'" : ""}}>疲倦</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c5" {{substr($casecare->cc_status.'00000',4,1)=='1' ? "checked='checked'" : ""}}>其他</label>
                        <label class="checkbox-inline"><input type="text" name="cc_status_other" class="input-sm" value="{{ $casecare->cc_status_other }}"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_drink" class="col-md-2 control-label">有无喝酒</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_drink"
                                                           id="cc_drink0" {{!$casecare->cc_drink ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_drink"
                                                           id="cc_drink1" {{$casecare->cc_drink==1 ? "checked='checked'" : ""}}>偶尔</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_drink"
                                                           id="cc_drink2" {{$casecare->cc_drink==2 ? "checked='checked'" : ""}}>常喝</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_wine" class="col-md-2 control-label">酒名</label>

                    <div class="col-md-10"><input type="text" name="cc_wine" class="form-control input-sm"
                                                  value="{{ $casecare->cc_wine }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_wineq" class="col-md-2 control-label">酒量c.c.</label>

                    <div class="col-md-10"><input type="text" name="cc_wineq" class="input-sm"
                                                  value="{{ $casecare->cc_wineq }}">c.c./天
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_smoke" class="col-md-2 control-label">有无抽烟</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smoke"
                                                           id="cc_smoke0" {{!$casecare->cc_smoke ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smoke"
                                                           id="cc_smoke1" {{$casecare->cc_smoke>=1 ? "checked='checked'" : ""}}>有</label>
                        <input type="text" name="cc_smoke_time" class="input-sm" value="{{ $casecare->cc_smoke }}">支/天
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mh" class="col-md-2 control-label">疾病史</label>

                    <div class="col-md-10"><input type="text" name="cc_mh" class="input-sm"
                                                  value="{{ $casecare->cc_mh }}" placeholder="诊断码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_fh" class="col-md-2 control-label">家族病史</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_fh"
                                                           id="cc_fh0" {{!$casecare->cc_fh ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_fh"
                                                           id="cc_fh1" {{$casecare->cc_fh==1 ? "checked='checked'" : ""}}>有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_fh_desc" class="col-md-2 control-label">上列病史</label>

                    <div class="col-md-10"><input type="text" name="cc_fh_desc" class="input-sm"
                                                  value="{{ $casecare->cc_fh_desc }}" placeholder="备注描述">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_drug_allergy" class="col-md-2 control-label">药物过敏</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_drug_allergy"
                                                           id="cc_drug_allergy0" {{!$casecare->cc_drug_allergy ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_drug_allergy"
                                                           id="cc_drug_allergy1" {{$casecare->cc_drug_allergy==1 ? "checked='checked'" : ""}}>有</label>
                        <input type="text" name="cc_drug_allergy_name" class="input-sm"
                               value="{{ $casecare->cc_drug_allergy_name }}" placeholder="对何种药物名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_activity" class="col-md-2 control-label">活动量</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_activity"
                                                           id="cc_activity0" {{!$casecare->cc_activity ? "checked='checked'" : ""}}>非劳动/卧床</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_activity"
                                                           id="cc_activity1" {{$casecare->cc_activity==1 ? "checked='checked'" : ""}}>轻度</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_activity"
                                                           id="cc_activity2" {{$casecare->cc_activity==2 ? "checked='checked'" : ""}}>中度</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_activity"
                                                           id="cc_activity3" {{$casecare->cc_activity==3 ? "checked='checked'" : ""}}>重度</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_medicaretype" class="col-md-2 control-label">医保类型</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_medicaretype"
                                                           id="cc_medicaretype0" {{!$casecare->cc_medicaretype ? "checked='checked'" : ""}}>省医保</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_medicaretype"
                                                           id="cc_medicaretype1" {{$casecare->cc_medicaretype==1 ? "checked='checked'" : ""}}>市医保</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_medicaretype"
                                                           id="cc_medicaretype2" {{$casecare->cc_medicaretype==2 ? "checked='checked'" : ""}}>哈尔滨市城镇居民医保</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_medicaretype"
                                                           id="cc_medicaretype3" {{$casecare->cc_medicaretype==3 ? "checked='checked'" : ""}}>省农村合作医疗</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_medicaretype"
                                                           id="cc_medicaretype4" {{$casecare->cc_medicaretype==3 ? "checked='checked'" : ""}}>省医保公务员</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_medicaretype"
                                                           id="cc_medicaretype5" {{$casecare->cc_medicaretype==3 ? "checked='checked'" : ""}}>市医保公务员</label>
                        <label class="radio-inline"><input type="radio" value="6" name="cc_medicaretype"
                                                           id="cc_medicaretype6" {{$casecare->cc_medicaretype==3 ? "checked='checked'" : ""}}>自费</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_jobtime" class="col-md-2 control-label">工作时间</label>

                    <div class="col-md-4">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_jobtime"
                                                           id="cc_jobtime0" {{$casecare->cc_jobtime==1 ? "checked='checked'" : ""}}>固定</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_jobtime"
                                                           id="cc_jobtime1" {{$casecare->cc_jobtime==2 ? "checked='checked'" : ""}}>轮班</label>
                    </div>
                </div>
                <div class="row">
                    <label for="cc_current_use" class="col-md-2 control-label">目前治疗方式</label>

                    <div class="col-md-10" id="cccurrent">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_current_use" id="cc_current0" {{empty($casecare->cc_current_use) ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_current_use" id="cc_current1" {{$casecare->cc_current_use ? "checked='checked'" : ""}}>有下列症状：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use1" {{substr($casecare->cc_current_use.'00000',0,1)=='1' ? "checked='checked'" : ""}}>口服药</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use2" {{substr($casecare->cc_current_use.'00000',1,1)=='1' ? "checked='checked'" : ""}}>胰岛素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use3" {{substr($casecare->cc_current_use.'00000',2,1)=='1' ? "checked='checked'" : ""}}>饮食控制</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use4" {{substr($casecare->cc_current_use.'00000',3,1)=='1' ? "checked='checked'" : ""}}>中药治疗</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use5" {{substr($casecare->cc_current_use.'00000',4,1)=='1' ? "checked='checked'" : ""}}>以上方式有持续<span class="text-danger">规则治疗</span></label>
                        <label class="checkbox-inline">开始年月
                            <select name="cc_starty" class="input-sm">
                                <option value="-1" {{-1==$casecare->cc_starty ? "selected='selected'" : ""}}>不详</option>
                                @for ($i = $year; $i > 1910; $i--)
                                    <option value='{{ $i }}' {{$i==$casecare->cc_starty ? "selected='selected'" : ""}}>{{ $i }}</option>
                                @endfor
                            </select>年
                            <select name="cc_startm" class="input-sm">
                                <option value="-1" {{-1==$casecare->cc_startm ? "selected='selected'" : ""}}>不详</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value='{{ $i }}' {{$i==$casecare->cc_startm ? "selected='selected'" : ""}}>{{ $i }}</option>
                                @endfor
                            </select>月
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_hinder">影响学习之因素</label>

                    <div class="col-md-10" id="cchinder">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_hinder" id="cc_hinder0" {{empty($casecare->cc_hinder) ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_hinder" id="cc_hinder1" {{$casecare->cc_hinder ? "checked='checked'" : ""}}>有下列症状：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_1" {{substr($casecare->cc_hinder.'000000000',0,1)=='1' ? "checked='checked'" : ""}}>失聪</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_2" {{substr($casecare->cc_hinder.'000000000',1,1)=='1' ? "checked='checked'" : ""}}>失明</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_3" {{substr($casecare->cc_hinder.'000000000',2,1)=='1' ? "checked='checked'" : ""}}>手部不灵活</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_4" {{substr($casecare->cc_hinder.'000000000',3,1)=='1' ? "checked='checked'" : ""}}>听力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_5" {{substr($casecare->cc_hinder.'000000000',4,1)=='1' ? "checked='checked'" : ""}}>视力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_6" {{substr($casecare->cc_hinder.'000000000',5,1)=='1' ? "checked='checked'" : ""}}>智力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_7" {{substr($casecare->cc_hinder.'000000000',6,1)=='1' ? "checked='checked'" : ""}}>情绪因素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_8" {{substr($casecare->cc_hinder.'000000000',7,1)=='1' ? "checked='checked'" : ""}}>疾病因素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_9" {{substr($casecare->cc_hinder.'000000000',8,1)=='1' ? "checked='checked'" : ""}}>其他</label>
                        <label class="checkbox-inline">简略说明：<input class="input-sm" type="text" name="cc_hinder_desc" value="{{ $casecare->cc_hinder_desc }}" placeholder="20字内"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_act_time_sel" class="col-md-2 control-label">运动次数</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_act_time_sel"
                                                           id="cc_act_time_sel0" {{!$casecare->cc_act_time ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_act_time_sel"
                                                           id="cc_act_time_sel1" {{$casecare->cc_act_time ? "checked='checked'" : ""}}>有</label>
                        <label class="radio-inline"><input class="input-sm" type="text" name="cc_act_time" value="{{ $casecare->cc_act_time }}">次/周</label>
                        <label class="radio-inline">运动时间：<input class="input-sm" type="text" name="cc_act_times" value="{{ $casecare->cc_act_times }}">分钟/次</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_act_kind">运动种类</label>

                    <div class="col-md-10">
                        <select name="cc_act_kind" class="input-sm">
                            @foreach($actkind as $key => $value)
                                <option value="{{ $key }}" {{"$key"==$casecare->cc_act_kind ? "selected='selected'" : ""}}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="cc_act_other" id="cc_act_other" class="input-sm" value="{{ $casecare->cc_act_other }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_edu" class="col-md-2 control-label">教育程度</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_edu"
                                                           id="cc_edu0" {{!$casecare->cc_edu ? "checked='checked'" : ""}}>不识字</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_edu"
                                                           id="cc_edu1" {{$casecare->cc_edu==1 ? "checked='checked'" : ""}}>识数字</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_edu"
                                                           id="cc_edu2" {{$casecare->cc_edu==2 ? "checked='checked'" : ""}}>识字</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_edu"
                                                           id="cc_edu3" {{$casecare->cc_edu==3 ? "checked='checked'" : ""}}>日本教育</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_edu"
                                                           id="cc_edu4" {{$casecare->cc_edu==4 ? "checked='checked'" : ""}}>国小</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_edu"
                                                           id="cc_edu5" {{$casecare->cc_edu==5 ? "checked='checked'" : ""}}>国中</label>
                        <label class="radio-inline"><input type="radio" value="6" name="cc_edu"
                                                           id="cc_edu6" {{$casecare->cc_edu==6 ? "checked='checked'" : ""}}>高中</label>
                        <label class="radio-inline"><input type="radio" value="7" name="cc_edu"
                                                           id="cc_edu7" {{$casecare->cc_edu==7 ? "checked='checked'" : ""}}>大专</label>
                        <label class="radio-inline"><input type="radio" value="8" name="cc_edu"
                                                           id="cc_edu8" {{$casecare->cc_edu==8 ? "checked='checked'" : ""}}>大学</label>
                        <label class="radio-inline"><input type="radio" value="9" name="cc_edu"
                                                           id="cc_edu9" {{$casecare->cc_edu==9 ? "checked='checked'" : ""}}>硕士</label>
                        <label class="radio-inline"><input type="radio" value="10" name="cc_edu"
                                                           id="cc_edu10" {{$casecare->cc_edu==10 ? "checked='checked'" : ""}}>博士</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_careself" class="col-md-2 control-label">自我照顾</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_careself"
                                                           id="cc_careself0" {{!$casecare->cc_careself ? "checked='checked'" : ""}}>独居</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_careself"
                                                           id="cc_careself1" {{$casecare->cc_careself==1 ? "checked='checked'" : ""}}>完全独立</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_careself"
                                                           id="cc_careself2" {{$casecare->cc_careself==2 ? "checked='checked'" : ""}}>需旁人照顾</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_careself"
                                                           id="cc_careself3" {{$casecare->cc_careself==3 ? "checked='checked'" : ""}}>完全由旁人照顾</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_careself"
                                                           id="cc_careself4" {{$casecare->cc_careself==4 ? "checked='checked'" : ""}}>安养中心<input
                                    class="input-sm" type="text" name="cc_careself_name"
                                    value="{{ $casecare->cc_careself_name }}"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman">照顾者名称</label>

                    <div class="col-md-10"><input class="form-control input-sm" type="text" name="cc_careman"
                                                  value="{{ $casecare->cc_careman }}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman_tel">照顾者电话</label>

                    <div class="col-md-10"><input class="form-control input-sm" type="text" name="cc_careman_tel"
                                                  value="{{ $casecare->cc_careman_tel }}"></div>
                </div>
                <div class="row">
                    <label class="col-md-2 control-label" for="cc_usebsm">使用血糖仪</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm"
                                                           id="cc_usebsm0" {{!$casecare->cc_usebsm ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm"
                                                           id="cc_usebsm1" {{$casecare->cc_usebsm ? "checked='checked'" : ""}}>有,</label>
                        <label class="radio-inline">厂牌或型号：
                            <select class="input-sm" name="cc_usebsm_name"
                                    onchange="if(this.value>0){cc_usebsm1.checked=true;cc_otherbsm.style.display='none'}else{cc_otherbsm.style.display='inline-block'}">
                                <option value="0">其他</option>
                                @foreach($bsms as $bsm)
                                    <option value="{{ $bsm->id }}" {{$bsm->id==$casecare->cc_usebsm ? "selected='selected'" : ""}}>{{ $bsm->bm_name }}</option>
                                @endforeach
                            </select>
                            <input class="input-sm" type="text" name="cc_otherbsm" id="cc_otherbsm" value="">
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_usebsm_frq">测试频率</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq0" {{!$casecare->cc_usebsm_frq ? "checked='checked'" : ""}}><input
                                    class="input-sm" type="text" name="cc_usebsm_frq_week"
                                    value="{{ $casecare->cc_usebsm_unit }}">次/周</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq1" {{$casecare->cc_usebsm_frq ? "checked='checked'" : ""}}><input
                                    class="input-sm" type="text" name="cc_usebsm_frq_month"
                                    value="{{ $casecare->cc_usebsm_unit }}">次/月</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_g6pd">G6PD</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_g6pd"
                                                           id="cc_g6pd0" {{$casecare->cc_g6pd==0 ? "checked='checked'" : ""}}>不详</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_g6pd"
                                                           id="cc_g6pd1" {{$casecare->cc_g6pd==1 ? "checked='checked'" : ""}}>无</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_g6pd"
                                                           id="cc_g6pd2" {{$casecare->cc_g6pd==2 ? "checked='checked'" : ""}}>有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_deathdate">死亡</label>

                    <div class="col-md-10">
                        <select class="input-sm" name="cc_deathdate">
                            <option value="-1" {{-1==$casecare->cc_deathdate ? "selected='selected'" : ""}}>不详</option>
                            @for ($i = $year; $i > 1999; $i--)
                                <option value="{{ $i }}" {{$i==$casecare->cc_deathdate ? "selected='selected'" : ""}}>{{ $i }}</option>
                            @endfor
                        </select>年
                        <select class="input-sm" name="cc_deathdatem">
                            <option value="-1" {{-1==$casecare->cc_deathdatem ? "selected='selected'" : ""}}>不详</option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}" {{$i==$casecare->cc_deathdatem ? "selected='selected'" : ""}}>{{ $i }}</option>
                            @endfor
                        </select>月
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone">本人是否使用智能型手机</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone"
                                                           id="cc_smartphone0" {{!$casecare->cc_smartphone ? "checked='checked'" : ""}}>否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone"
                                                           id="cc_smartphone1" {{$casecare->cc_smartphone==1 ? "checked='checked'" : ""}}>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_wifi3g">智能型手机上网功能</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_wifi3g"
                                                           id="cc_wifi3g1" {{$casecare->cc_wifi3g==1 ? "checked='checked'" : ""}}>Wi-Fi</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_wifi3g"
                                                           id="cc_wifi3g2" {{$casecare->cc_wifi3g==2 ? "checked='checked'" : ""}}>行动上网</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone_family">家属是否使用智能型手机</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone_family"
                                                           id="cc_smartphone_family0" {{!$casecare->cc_smartphone_family ? "checked='checked'" : ""}}>否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone_family"
                                                           id="cc_smartphone_family1" {{$casecare->cc_smartphone_family==1 ? "checked='checked'" : ""}}>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_familyupload">家属可否协助传输血糖数值</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_familyupload"
                                                           id="cc_familyupload0" {{!$casecare->cc_familyupload ? "checked='checked'" : ""}}>否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_familyupload"
                                                           id="cc_familyupload1" {{$casecare->cc_familyupload==1 ? "checked='checked'" : ""}}>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_uploadtodm">是否愿意将血糖数值传输回共照管理系统</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_uploadtodm"
                                                           id="cc_uploadtodm0" {{!$casecare->cc_uploadtodm ? "checked='checked'" : ""}}>否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_uploadtodm"
                                                           id="cc_uploadtodm1" {{$casecare->cc_uploadtodm==1 ? "checked='checked'" : ""}}>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_appexp">是否安装过健康管理App软件</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_appexp"
                                                           id="cc_appexp0" {{!$casecare->cc_appexp ? "checked='checked'" : ""}}>否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_appexp"
                                                           id="cc_appexp1" {{$casecare->cc_appexp==1 ? "checked='checked'" : ""}}>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_lastexam">最近一次验血糖时间</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_lastexam"
                                                           id="cc_lastexam1" {{$casecare->cc_lastexam==1 ? "checked='checked'" : ""}}>一周内</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_lastexam"
                                                           id="cc_lastexam2" {{$casecare->cc_lastexam==2 ? "checked='checked'" : ""}}>一个月内</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_lastexam"
                                                           id="cc_lastexam3" {{$casecare->cc_lastexam==3 ? "checked='checked'" : ""}}>三个月内</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_lastexam"
                                                           id="cc_lastexam4" {{$casecare->cc_lastexam==4 ? "checked='checked'" : ""}}>半年内</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_lastexam"
                                                           id="cc_lastexam5" {{$casecare->cc_lastexam==5 ? "checked='checked'" : ""}}>半年以上</label>
                    </div>
                </div>

                <a class="btn btn-info" href="{{ route('patient.index') }}">历史纪录</a>
                <!-- a class="btn btn-default" href="{{ route('patient.index') }}">返回</a -->
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/patient.js') !!}
@stop
