@extends('layout')

@section('title')
    患者资料-查
@stop

@section('pactive')
    active
@stop

@section('css')
    {!! Html::style('css/patient.css') !!}
@stop

@section('content')
    <div class="page-header">
        <h3>病患基本数据 / 查</h3>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form action="#" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="nome" class="col-md-2 control-label">#</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->id }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_patientid }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_personid" class="col-md-2 control-label">身份证号</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_personid }}</div>
                </div>
                <div class="form-group">
                    <label for="account" class="col-md-2 control-label">登入帐号</label>

                    <div class="col-md-10" form-control-static>{{ $account }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_name" class="col-md-2 control-label">姓名</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_name }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_birthday" class="col-md-2 control-label">生日</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_birthday }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_birthday" class="col-md-2 control-label">年龄</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_age }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_sex" class="col-md-2 control-label">性别</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_sex ? "男" : "女" }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_height }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_weight }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_tel1 }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_tel2 }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_mobile1 }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_mobile2 }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_area">地区</label>

                    <div class="col-md-10 form-control-static">
                        @foreach($areas as $key => $value)
                            {{ "$key" == $patientprofile->pp_area ? "$value" : "" }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_doctor">负责医生</label>

                    <div class="col-md-10 form-control-static">
                        @foreach($doctors as $key => $value)
                            {{ "$key" == $patientprofile->pp_doctor ? "$value" : "" }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_remark" class="col-md-2 control-label">备注</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_remark }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_source">患者来源</label>

                    <div class="col-md-10 form-control-static">
                        @foreach($sources as $key => $value)
                            {{ "$key" == $patientprofile->pp_source ? "$value" : "" }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_occupation">职业</label>

                    <div class="col-md-10 form-control-static">
                        @foreach($occupations as $key => $value)
                            {{ "$key" == $patientprofile->pp_occupation ? "$value" : "" }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_address" class="col-md-2 control-label">联络地址</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_address }}</div>
                </div>
                <div class="form-group">
                    <label for="pp_email" class="col-md-2 control-label">电子邮件</label>

                    <div class="col-md-10 form-control-static">{{ $patientprofile->pp_email }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_contactor" class="col-md-2 control-label">紧急联络人</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_contactor }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_contactor_tel" class="col-md-2 control-label">紧急联络人电话</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_contactor_tel }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_language" class="col-md-2 control-label">语言</label>

                    <div class="col-md-10 form-control-static">
                        @foreach($languages as $key => $value)
                            {{ "$key" == $casecare->cc_language ? "$value" : "" }}
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mdate" class="col-md-2 control-label">诊断日期</label>

                    <div class="col-md-10 form-control-static">
                        发生于 西元年{{ -1 == $casecare->cc_mdate ? "不详" : "" }}
                        @for ($i = $year; $i > 1910; $i--)
                            {{ $i == $casecare->cc_mdate ? $i : "" }}
                        @endfor
                        年
                        {{ -1 == $casecare->cc_mdatem ? "不详" : "" }}
                        @for ($i = 1; $i < 13; $i++)
                            {{ $i == $casecare->cc_mdatem ? $i : "" }}
                        @endfor
                        月
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_type" class="col-md-2 control-label">症状型态</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{Text::behidden($casecare->cc_type, 0)}}"><input type="radio" value="0" name="cc_type" id="cc_type0" {{Text::checked($casecare->cc_type,0)}} disabled>Type1</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_type, 1)}}"><input type="radio" value="1" name="cc_type" id="cc_type1" {{Text::checked($casecare->cc_type,1)}} disabled>Type2</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_type, 2)}}"><input type="radio" value="2" name="cc_type" id="cc_type2" {{Text::checked($casecare->cc_type,2)}} disabled>GDM</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_type, 3)}}"><input type="radio" value="3" name="cc_type" id="cc_type3" {{Text::checked($casecare->cc_type,3)}} disabled>其它</label>
                        <label class="checkbox-inline">{{ $casecare->cc_type_other }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_ibw" class="col-md-2 control-label">IBW</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_ibw }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_bmi" class="col-md-2 control-label">BMI</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_bmi }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_waist" class="col-md-2 control-label">腰围</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_waist }}公分</div>
                </div>
                <div class="form-group">
                    <label for="cc_butt" class="col-md-2 control-label">臀围</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_butt }}公分</div>
                </div>
                <div class="form-group">
                    <label for="cc_status" class="col-md-2 control-label">发病状况</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{empty($casecare->cc_status) ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_status" id="cc_status0" {{empty($casecare->cc_status) ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_status ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_status" id="cc_status1" {{$casecare->cc_status ? "checked='checked'" : ""}} disabled>有下列症状：</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_status.'00000',0,1), '1')}}"><input type="checkbox" value="1" name="cc_status_c1" {{Text::checked(substr($casecare->cc_status.'00000',0,1),'1')}} disabled>口干</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_status.'00000',1,1), '1')}}"><input type="checkbox" value="1" name="cc_status_c2" {{Text::checked(substr($casecare->cc_status.'00000',1,1),'1')}} disabled>多尿</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_status.'00000',2,1), '1')}}"><input type="checkbox" value="1" name="cc_status_c3" {{Text::checked(substr($casecare->cc_status.'00000',2,1),'1')}} disabled>饥饿</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_status.'00000',3,1), '1')}}"><input type="checkbox" value="1" name="cc_status_c4" {{Text::checked(substr($casecare->cc_status.'00000',3,1),'1')}} disabled>疲倦</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_status.'00000',4,1), '1')}}"><input type="checkbox" value="1" name="cc_status_c5" {{Text::checked(substr($casecare->cc_status.'00000',4,1),'1')}} disabled>其他</label>
                        <label class="checkbox-inline">{{ $casecare->cc_status_other }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_drink" class="col-md-2 control-label">有无喝酒</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_drink ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_drink" id="cc_drink0"
                                                           {{!$casecare->cc_drink ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_drink,1)}}"><input type="radio" value="1" name="cc_drink" id="cc_drink1"
                                                           {{Text::checked($casecare->cc_drink,1)}} disabled>偶尔</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_drink,2)}}"><input type="radio" value="2" name="cc_drink" id="cc_drink2"
                                                           {{Text::checked($casecare->cc_drink,2)}} disabled>常喝</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_wine" class="col-md-2 control-label">酒名</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_wine }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_wineq" class="col-md-2 control-label">酒量c.c.</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_wineq }}c.c./天</div>
                </div>
                <div class="form-group">
                    <label for="cc_smoke" class="col-md-2 control-label">有无抽烟</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_smoke ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_smoke" id="cc_smoke0"
                                                           {{!$casecare->cc_smoke ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_smoke>=1 ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_smoke" id="cc_smoke1"
                                                           {{$casecare->cc_smoke>=1 ? "checked='checked'" : ""}} disabled>有</label>
                        <label class="radio-inline">{{ $casecare->cc_smoke }}支/天</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mh" class="col-md-2 control-label">疾病史</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_mh }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_fh" class="col-md-2 control-label">家族病史</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_fh ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_fh" id="cc_fh0"
                                                           {{!$casecare->cc_fh ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_fh,1)}}"><input type="radio" value="1" name="cc_fh" id="cc_fh1"
                                                           {{Text::checked($casecare->cc_fh,1)}} disabled>有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_fh_desc" class="col-md-2 control-label">上列病史</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_fh_desc }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_drug_allergy" class="col-md-2 control-label">药物过敏</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_drug_allergy ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_drug_allergy"
                                                           id="cc_drug_allergy0"
                                                           {{!$casecare->cc_drug_allergy ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_drug_allergy,1)}}"><input type="radio" value="1" name="cc_drug_allergy"
                                                           id="cc_drug_allergy1"
                                                           {{Text::checked($casecare->cc_drug_allergy,1)}} disabled>有</label>
                        {{ $casecare->cc_drug_allergy_name }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_activity" class="col-md-2 control-label">活动量</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_activity ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_activity" id="cc_activity0"
                                                           {{!$casecare->cc_activity ? "checked='checked'" : ""}} disabled>非劳动/卧床</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_activity,1)}}"><input type="radio" value="1" name="cc_activity" id="cc_activity1"
                                                           {{Text::checked($casecare->cc_activity,1)}} disabled>轻度</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_activity,2)}}"><input type="radio" value="2" name="cc_activity" id="cc_activity2"
                                                           {{Text::checked($casecare->cc_activity,2)}} disabled>中度</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_activity,3)}}"><input type="radio" value="3" name="cc_activity" id="cc_activity3"
                                                           {{Text::checked($casecare->cc_activity,3)}} disabled>重度</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_medicaretype" class="col-md-2 control-label">医保类型</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_medicaretype ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_medicaretype"
                                                           id="cc_medicaretype0"
                                                           {{!$casecare->cc_medicaretype ? "checked='checked'" : ""}} disabled>省医保</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_medicaretype,1)}}"><input type="radio" value="1" name="cc_medicaretype"
                                                           id="cc_medicaretype1"
                                                           {{Text::checked($casecare->cc_medicaretype,1)}} disabled>市医保</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_medicaretype,2)}}"><input type="radio" value="2" name="cc_medicaretype"
                                                           id="cc_medicaretype2"
                                                           {{Text::checked($casecare->cc_medicaretype,2)}} disabled>哈尔滨市城镇居民医保</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_medicaretype,3)}}"><input type="radio" value="3" name="cc_medicaretype"
                                                           id="cc_medicaretype3"
                                                           {{Text::checked($casecare->cc_medicaretype,3)}} disabled>省农村合作医疗</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_jobtime" class="col-md-2 control-label">工作时间</label>

                    <div class="col-md-4">
                        <label class="radio-inline {{Text::behidden($casecare->cc_jobtime,1)}}"><input type="radio" value="1" name="cc_jobtime" id="cc_jobtime0"
                                                           {{Text::checked($casecare->cc_jobtime,1)}} disabled>固定</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_jobtime,2)}}"><input type="radio" value="2" name="cc_jobtime" id="cc_jobtime1"
                                                           {{Text::checked($casecare->cc_jobtime,2)}} disabled>轮班</label>
                    </div>
                </div>
                <div class="row">
                    <label for="cc_current_use" class="col-md-2 control-label">目前治疗方式</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{empty($casecare->cc_current_use) ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_current" id="cc_current0" {{empty($casecare->cc_current_use) ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_current_use ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_current" id="cc_current1" {{$casecare->cc_current_use ? "checked='checked'" : ""}} disabled>有：</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_current_use.'00000',0,1),'1')}}"><input type="checkbox" value="1" name="cc_current_use1" {{Text::checked(substr($casecare->cc_current_use.'00000',0,1),'1')}} disabled>口服药</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_current_use.'00000',1,1),'1')}}"><input type="checkbox" value="1" name="cc_current_use2" {{Text::checked(substr($casecare->cc_current_use.'00000',1,1),'1')}} disabled>胰岛素</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_current_use.'00000',2,1),'1')}}"><input type="checkbox" value="1" name="cc_current_use3" {{Text::checked(substr($casecare->cc_current_use.'00000',2,1),'1')}} disabled>饮食控制</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_current_use.'00000',3,1),'1')}}"><input type="checkbox" value="1" name="cc_current_use4" {{Text::checked(substr($casecare->cc_current_use.'00000',3,1),'1')}} disabled>中药治疗</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_current_use.'00000',4,1),'1')}}"><input type="checkbox" value="1" name="cc_current_use5" {{Text::checked(substr($casecare->cc_current_use.'00000',4,1),'1')}} disabled>以上方式有持续<span class="text-danger">规则治疗</span></label>
                        <label class="checkbox-inline">开始年月
                            {{-1==$casecare->cc_starty ? "不详" : ""}}
                            @for ($i = $year; $i > 1910; $i--)
                                {{$i==$casecare->cc_starty ? $i : ""}}
                            @endfor
                            年
                            {{-1==$casecare->cc_startm ? "不详" : ""}}
                            @for ($i = 1; $i < 13; $i++)
                                {{$i==$casecare->cc_startm ? $i : ""}}
                            @endfor
                            月
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_hinder">影响学习之因素</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{empty($casecare->cc_hinder) ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_hinder" id="cc_hinder0" {{empty($casecare->cc_hinder) ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_hinder ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_hinder" id="cc_hinder1" {{$casecare->cc_hinder ? "checked='checked'" : ""}} disabled>有：</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',0,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_1" {{Text::checked(substr($casecare->cc_hinder.'000000000',0,1),'1')}} disabled>失聪</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',1,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_2" {{Text::checked(substr($casecare->cc_hinder.'000000000',1,1),'1')}} disabled>失明</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',2,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_3" {{Text::checked(substr($casecare->cc_hinder.'000000000',2,1),'1')}} disabled>手部不灵活</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',3,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_4" {{Text::checked(substr($casecare->cc_hinder.'000000000',3,1),'1')}} disabled>听力障碍</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',4,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_5" {{Text::checked(substr($casecare->cc_hinder.'000000000',4,1),'1')}} disabled>视力障碍</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',5,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_6" {{Text::checked(substr($casecare->cc_hinder.'000000000',5,1),'1')}} disabled>智力障碍</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',6,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_7" {{Text::checked(substr($casecare->cc_hinder.'000000000',6,1),'1')}} disabled>情绪因素</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',7,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_8" {{Text::checked(substr($casecare->cc_hinder.'000000000',7,1),'1')}} disabled>疾病因素</label>
                        <label class="checkbox-inline {{Text::behidden(substr($casecare->cc_hinder.'000000000',8,1),'1')}}"><input type="checkbox" value="1" name="cc_hinder_9" {{Text::checked(substr($casecare->cc_hinder.'000000000',8,1),'1')}} disabled>其他</label>
                        <label class="checkbox-inline">简略说明：{{ $casecare->cc_hinder_desc }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_act_time_sel" class="col-md-2 control-label">运动次数</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_act_time ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_act_time_sel"
                                                           id="cc_act_time_sel0"
                                                           {{!$casecare->cc_act_time ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_act_time ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_act_time_sel"
                                                           id="cc_act_time_sel1"
                                                           {{$casecare->cc_act_time ? "checked='checked'" : ""}} disabled>有</label>
                        <label class="radio-inline">{{ $casecare->cc_act_time }}次/周</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_act_kind">运动种类</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_act_kind }}</div>
                </div>
                <div class="form-group">
                    <label for="cc_edu" class="col-md-2 control-label">教育程度</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_edu ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_edu" id="cc_edu0"
                                                           {{!$casecare->cc_edu ? "checked='checked'" : ""}} disabled>不识字</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,1)}}"><input type="radio" value="1" name="cc_edu" id="cc_edu1"
                                                           {{Text::checked($casecare->cc_edu,1)}} disabled>识数字</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,2)}}"><input type="radio" value="2" name="cc_edu" id="cc_edu2"
                                                           {{Text::checked($casecare->cc_edu,2)}} disabled>识字</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,3)}}"><input type="radio" value="3" name="cc_edu" id="cc_edu3"
                                                           {{Text::checked($casecare->cc_edu,3)}} disabled>日本教育</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,4)}}"><input type="radio" value="4" name="cc_edu" id="cc_edu4"
                                                           {{Text::checked($casecare->cc_edu,4)}} disabled>国小</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,5)}}"><input type="radio" value="5" name="cc_edu" id="cc_edu5"
                                                           {{Text::checked($casecare->cc_edu,5)}} disabled>国中</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,6)}}"><input type="radio" value="6" name="cc_edu" id="cc_edu6"
                                                           {{Text::checked($casecare->cc_edu,6)}} disabled>高中</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,7)}}"><input type="radio" value="7" name="cc_edu" id="cc_edu7"
                                                           {{Text::checked($casecare->cc_edu,7)}} disabled>大专</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,8)}}"><input type="radio" value="8" name="cc_edu" id="cc_edu8"
                                                           {{Text::checked($casecare->cc_edu,8)}} disabled>大学</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,9)}}"><input type="radio" value="9" name="cc_edu" id="cc_edu9"
                                                           {{Text::checked($casecare->cc_edu,9)}} disabled>硕士</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_edu,10)}}"><input type="radio" value="10" name="cc_edu" id="cc_edu10"
                                                           {{Text::checked($casecare->cc_edu,10)}} disabled>博士</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_careself" class="col-md-2 control-label">自我照顾</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_careself ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_careself" id="cc_careself0"
                                                           {{!$casecare->cc_careself ? "checked='checked'" : ""}} disabled>独居</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_careself,1)}}"><input type="radio" value="1" name="cc_careself" id="cc_careself1"
                                                           {{Text::checked($casecare->cc_careself,1)}} disabled>完全独立</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_careself,2)}}"><input type="radio" value="2" name="cc_careself" id="cc_careself2"
                                                           {{Text::checked($casecare->cc_careself,2)}} disabled>需旁人照顾</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_careself,3)}}"><input type="radio" value="3" name="cc_careself" id="cc_careself3"
                                                           {{Text::checked($casecare->cc_careself,3)}} disabled>完全由旁人照顾</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_careself,4)}}"><input type="radio" value="4" name="cc_careself" id="cc_careself4"
                                                           {{Text::checked($casecare->cc_careself,4)}} disabled>安养中心{{ $casecare->cc_careself_name }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman">照顾者名称</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_careman }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman_tel">照顾者电话</label>

                    <div class="col-md-10 form-control-static">{{ $casecare->cc_careman_tel }}</div>
                </div>
                <div class="row">
                    <label class="col-md-2 control-label" for="cc_usebsm">使用血糖仪</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_usebsm ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_usebsm" id="cc_usebsm0"
                                                           {{!$casecare->cc_usebsm ? "checked='checked'" : ""}} disabled>无</label>
                        <label class="radio-inline {{$casecare->cc_usebsm ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_usebsm" id="cc_usebsm1"
                                                           {{$casecare->cc_usebsm ? "checked='checked'" : ""}} disabled>有,</label>
                        <label class="radio-inline">厂牌或型号：
                            @foreach($bsms as $bsm)
                                {{$bsm->id==$casecare->cc_usebsm ? $bsm->bm_name : ""}}
                            @endforeach
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_usebsm_frq">测试频率</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{$casecare->cc_usebsm_frq ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq0"
                                                           {{!$casecare->cc_usebsm_frq ? "checked='checked'" : ""}} disabled>{{ $casecare->cc_usebsm_unit }}
                            次/周</label>
                        <label class="radio-inline {{$casecare->cc_usebsm_frq ? '' : 'hidden'}}"><input type="radio" value="1" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq1"
                                                           {{$casecare->cc_usebsm_frq ? "checked='checked'" : ""}} disabled>{{ $casecare->cc_usebsm_unit }}
                            次/月</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_g6pd">G6PD</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{Text::behidden($casecare->cc_g6pd,0)}}"><input type="radio" value="0" name="cc_g6pd"
                                                           id="cc_g6pd0" {{Text::checked($casecare->cc_g6pd,0)}} disabled>不详</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_g6pd,1)}}"><input type="radio" value="1" name="cc_g6pd" id="cc_g6pd1"
                                                           {{Text::checked($casecare->cc_g6pd,1)}} disabled>无</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_g6pd,2)}}"><input type="radio" value="2" name="cc_g6pd" id="cc_g6pd2"
                                                           {{Text::checked($casecare->cc_g6pd,2)}} disabled>有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_deathdate">死亡</label>

                    <div class="col-md-10 form-control-static">
                        {{-1==$casecare->cc_deathdate ? "不详" : ""}}
                        @for ($i = $year; $i > 1999; $i--)
                            {{$i==$casecare->cc_deathdate ? $i : ""}}
                        @endfor
                        年
                        {{-1==$casecare->cc_deathdatem ? "不详" : ""}}
                        @for ($i = 1; $i < 13; $i++)
                            {{$i==$casecare->cc_deathdatem ? $i : ""}}
                        @endfor
                        月
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone">本人是否使用智慧型手机</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_smartphone ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_smartphone"
                                                           id="cc_smartphone0"
                                                           {{!$casecare->cc_smartphone ? "checked='checked'" : ""}} disabled>否</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_smartphone,1)}}"><input type="radio" value="1" name="cc_smartphone"
                                                           id="cc_smartphone1"
                                                           {{Text::checked($casecare->cc_smartphone,1)}} disabled>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_wifi3g">智慧型手机上网功能</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{Text::behidden($casecare->cc_wifi3g,1)}}"><input type="radio" value="1" name="cc_wifi3g" id="cc_wifi3g1"
                                                           {{Text::checked($casecare->cc_wifi3g,1)}} disabled>Wi-Fi</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_wifi3g,2)}}"><input type="radio" value="2" name="cc_wifi3g" id="cc_wifi3g2"
                                                           {{Text::checked($casecare->cc_wifi3g,2)}} disabled>行动上网</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone_family">家属是否使用智慧型手机</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_smartphone_family ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_smartphone_family"
                                                           id="cc_smartphone_family0"
                                                           {{!$casecare->cc_smartphone_family ? "checked='checked'" : ""}} disabled>否</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_smartphone_family,1)}}"><input type="radio" value="1" name="cc_smartphone_family"
                                                           id="cc_smartphone_family1"
                                                           {{Text::checked($casecare->cc_smartphone_family,1)}} disabled>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_familyupload">家属可否协助传输血糖数值</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_familyupload ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_familyupload"
                                                           id="cc_familyupload0"
                                                           {{!$casecare->cc_familyupload ? "checked='checked'" : ""}} disabled>否</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_familyupload,1)}}"><input type="radio" value="1" name="cc_familyupload"
                                                           id="cc_familyupload1"
                                                           {{Text::checked($casecare->cc_familyupload,1)}} disabled>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_uploadtodm">是否愿意将血糖数值传输回共照管理系统</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_uploadtodm ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_uploadtodm"
                                                           id="cc_uploadtodm0"
                                                           {{!$casecare->cc_uploadtodm ? "checked='checked'" : ""}} disabled>否</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_uploadtodm,1)}}"><input type="radio" value="1" name="cc_uploadtodm"
                                                           id="cc_uploadtodm1"
                                                           {{Text::checked($casecare->cc_uploadtodm,1)}} disabled>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_appexp">是否安装过健康管理App软件</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{!$casecare->cc_appexp ? '' : 'hidden'}}"><input type="radio" value="0" name="cc_appexp" id="cc_appexp0"
                                                           {{!$casecare->cc_appexp ? "checked='checked'" : ""}} disabled>否</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_appexp,1)}}"><input type="radio" value="1" name="cc_appexp" id="cc_appexp1"
                                                           {{Text::checked($casecare->cc_appexp,1)}} disabled>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_lastexam">最近一次验血糖时间</label>

                    <div class="col-md-10 form-control-static">
                        <label class="radio-inline {{Text::behidden($casecare->cc_lastexam,1)}}"><input type="radio" value="1" name="cc_lastexam" id="cc_lastexam1"
                                                           {{Text::checked($casecare->cc_lastexam,1)}} disabled>一周内</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_lastexam,2)}}"><input type="radio" value="2" name="cc_lastexam" id="cc_lastexam2"
                                                           {{Text::checked($casecare->cc_lastexam,2)}} disabled>一个月内</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_lastexam,3)}}"><input type="radio" value="3" name="cc_lastexam" id="cc_lastexam3"
                                                           {{Text::checked($casecare->cc_lastexam,3)}} disabled>三个月内</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_lastexam,4)}}"><input type="radio" value="4" name="cc_lastexam" id="cc_lastexam4"
                                                           {{Text::checked($casecare->cc_lastexam,4)}} disabled>半年内</label>
                        <label class="radio-inline {{Text::behidden($casecare->cc_lastexam,5)}}"><input type="radio" value="5" name="cc_lastexam" id="cc_lastexam5"
                                                           {{Text::checked($casecare->cc_lastexam,5)}} disabled>半年以上</label>
                    </div>
                </div>

            </form>

            <a class="btn btn-default" href="{{ route('patient.index') }}">返回</a>
            <a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a>

            <form action="{{ route('patient.destroy', $patientprofile->id) }}" method="POST" style="display: inline;"
                  onsubmit="if(confirm('确定删除?')) { return true } else { return false };"><input type="hidden"
                                                                                                name="_method"
                                                                                                value="DELETE"><input
                        type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="btn btn-danger" type="submit">删</button>
            </form>
        </div>
    </div>

@endsection
