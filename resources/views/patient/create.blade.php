@extends('layout')

@section('title')
    患者资料-增
@stop

@section('pactive')
    active
@stop

@section('css')
    {!! Html::style('css/patient.css') !!}
@stop

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>患者基本资料 / 增</h3>
        </div>

        <div class="col-md-12">
            @include('errors.list')
            @if(is_null($err_msg))
            <form action="{{ route('patient.store') }}" method="POST" class="form-horizontal" role="form"
                  data-toggle="validator">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group has-feedback">
                    <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>

                    <div class="col-md-10">
                        <input type="text" name="pp_patientid" id="pp_patientid" class="form-control input-sm"
                               pattern="^[_A-z0-9]{1,}$" maxlength="18" data-minlength="18"
                               data-minlength-error="输入文字长度不足"
                               value="{{ $patientid ? $patientid : old('pp_patientid') }}" placeholder="请输入身份证号" required>
                        <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_personid" class="col-md-2 control-label">身份证号</label>

                    <div class="col-md-10"><input type="text" name="pp_personid" id="pp_personid"
                                                  class="form-control input-sm" value="{{ old('pp_personid') }}"
                                                  placeholder="输入病历号码后会带入此处" readonly></div>
                </div>
                <div class="form-group">
                    <label for="account" class="col-md-2 control-label">登入帐号</label>

                    <div class="col-md-10"><input type="text" name="account" id="account"
                                                  class="form-control input-sm" value="{{ old('account') }}"
                                                  placeholder="输入病历号码后会带入此处" readonly></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="pp_name" class="col-md-2 control-label">姓名</label>

                    <div class="col-md-10">
                        <input type="text" name="pp_name" id="pp_name" class="form-control input-sm"
                               value="{{ old('pp_name') }}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_birthday" class="col-md-2 control-label">生日</label>

                    <div class="col-md-10"><input type="text" name="pp_birthday" id="pp_birthday"
                                                  class="form-control input-sm datepicker" data-date-format="yyyy-mm-dd"
                                                  data-date-autoclose="true" data-date-clear-btn="true"
                                                  data-date-today-highlight="true" data-date-today-btn="linked"
                                                  data-date-language="zh-TW" value="{{ old('pp_birthday') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_age" class="col-md-2 control-label">年龄</label>

                    <div class="col-md-10"><input type="number" name="pp_age" id="pp_age" class="form-control input-sm"
                                                  value="{{ old('pp_age') }}" placeholder="输入身分证号后会自动计算此处"></div>
                </div>
                <div class="form-group">
                    <label for="pp_sex" class="col-md-2 control-label">性别</label>

                    <div class="col-md-10"><select name="pp_sex" class="form-control input-sm">
                            <option value="0">女</option>
                            <option value="1">男</option>
                        </select></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>

                    <div class="col-md-10">
                        <input type="number" min="10.0" max="200.0" step="any" name="pp_height"
                               id="pp_height"
                               class="form-control input-sm" value="{{ old('pp_height') }}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>

                    <div class="col-md-10">
                        <input type="number" min="10.0" max="200.0" step="any" name="pp_weight" id="pp_weight"
                               class="form-control input-sm" value="{{ old('pp_weight') }}" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>

                    <div class="col-md-10"><input type="text" name="pp_tel1" class="form-control input-sm"
                                                  value="{{ old('pp_tel1') }}"></div>
                </div>
                <div class="form-group">
                    <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>

                    <div class="col-md-10"><input type="text" name="pp_tel2" class="form-control input-sm"
                                                  value="{{ old('pp_tel2') }}"></div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>

                    <div class="col-md-10"><input type="text" name="pp_mobile1" class="form-control input-sm"
                                                  value="{{ old('pp_mobile1') }}"></div>
                </div>
                <div class="form-group">
                    <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>

                    <div class="col-md-10"><input type="text" name="pp_mobile2" class="form-control input-sm"
                                                  value="{{ old('pp_mobile2') }}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_area">地区</label>

                    <div class="col-md-10">
                        <select name="pp_area" class="input-sm">
                            @foreach($areas as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="pp_area_other" class="input-sm" value="{{ old('pp_area_other') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_doctor">负责医生</label>

                    <div class="col-md-10">
                        <select name="pp_doctor" class="form-control input-sm">
                            @foreach($doctors as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_remark" class="col-md-2 control-label">备注</label>

                    <div class="col-md-10"><input type="text" name="pp_remark" class="form-control input-sm"
                                                  value="{{ old('pp_remark') }}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_source">患者来源</label>

                    <div class="col-md-10">
                        <select name="pp_source" class="input-sm">
                            @foreach($sources as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="pp_source_other" class="input-sm" value="{{ old('pp_source_other') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="pp_occupation">职业</label>

                    <div class="col-md-10">
                        <select name="pp_occupation" class="input-sm">
                            @foreach($occupations as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="pp_occupation_other" class="input-sm" value="{{ old('pp_occupation_other') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pp_address" class="col-md-2 control-label">联络地址</label>

                    <div class="col-md-10"><input type="text" name="pp_address" class="form-control input-sm"
                                                  value="{{ old('pp_address') }}"></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="pp_email" class="col-md-2 control-label">电子邮件</label>

                    <div class="col-md-10">
                        <input type="email" name="pp_email" id="pp_email"
                               class="form-control input-sm" value="{{ old('pp_email') }}">
                        <span class="glyphicon glyphicon-envelope form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="cc_contactor" class="col-md-2 control-label">紧急联络人</label>

                    <div class="col-md-10"><input type="text" name="cc_contactor" class="form-control input-sm"
                                                  value="{{ old('cc_contactor') }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_contactor_tel" class="col-md-2 control-label">紧急联络人电话</label>

                    <div class="col-md-10"><input type="text" name="cc_contactor_tel" class="form-control input-sm"
                                                  value="{{ old('cc_contactor_tel') }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_language" class="col-md-2 control-label">语言</label>

                    <div class="col-md-10">
                        <select name="cc_language" class="form-control input-sm">
                            @foreach($languages as $key => $value)
                                <option value="{{ $key }}" {{ $key==0 ? 'selected="selected"' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mdate" class="col-md-2 control-label">诊断日期</label>

                    <div class="col-md-10">
                        发生于 西元年
                        <select name="cc_mdate" id="cc_mdate" class="input-sm">
                            <option value="-1">不详</option>
                            @for ($i = $year; $i > 1910; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>年
                        <select name="cc_mdatem" class="input-sm">
                            <option value="-1">不详</option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>月
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_type" class="col-md-2 control-label">症状型态</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_type"
                                                           id="cc_type0">Type1</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_type" id="cc_type1" checked>Type2</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_type"
                                                           id="cc_type2">GDM</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_type"
                                                           id="cc_type3">其他</label>
                        <input type="text" name="cc_type_other" class="input-sm" value="{{ old('cc_type_other') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_ibw" class="col-md-2 control-label">IBW</label>

                    <div class="col-md-10"><input type="number" name="cc_ibw" id="cc_ibw" min="1.0" max="200.0"
                                                  step="any" class="form-control input-sm"
                                                  value="{{ old('cc_ibw') }}" placeholder="输入身高、体重后会自动计算此处"></div>
                </div>
                <div class="form-group">
                    <label for="cc_bmi" class="col-md-2 control-label">BMI</label>

                    <div class="col-md-10"><input type="number" name="cc_bmi" id="cc_bmi" min="1.0" max="200.0"
                                                  step="any" class="form-control input-sm"
                                                  value="{{ old('cc_bmi') }}" placeholder="输入身高、体重后会自动计算此处"></div>
                </div>
                <div class="form-group">
                    <label for="cc_waist" class="col-md-2 control-label">腰围</label>

                    <div class="col-md-10"><input type="number" name="cc_waist" class="input-sm"
                                                  value="{{ old('cc_waist') }}">公分
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_butt" class="col-md-2 control-label">臀围</label>

                    <div class="col-md-10"><input type="number" name="cc_butt" class="input-sm"
                                                  value="{{ old('cc_butt') }}">公分
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_status" class="col-md-2 control-label">发病状况</label>

                    <div class="col-md-10" id="ccstatus">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_status" id="cc_status0" checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_status" id="cc_status1">有下列症状：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c1" id="cc_status_c1" disabled="disabled">口干</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c2" id="cc_status_c2" disabled="disabled">多尿</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c3" id="cc_status_c3" disabled="disabled">饥饿</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c4" id="cc_status_c4" disabled="disabled">疲倦</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c5" id="cc_status_c5" disabled="disabled">其他</label>
                        <input type="text" name="cc_status_other" id="cc_status_other" class="input-sm" value="{{ old('cc_status_other') }}" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_drink" class="col-md-2 control-label">有无喝酒</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_drink" id="cc_drink0"
                                                           checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_drink"
                                                           id="cc_drink1">偶尔</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_drink"
                                                           id="cc_drink2">常喝</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_wine" class="col-md-2 control-label">酒名</label>

                    <div class="col-md-10"><input type="text" name="cc_wine" class="form-control input-sm"
                                                  value="{{ old('cc_wine') }}"></div>
                </div>
                <div class="form-group">
                    <label for="cc_wineq" class="col-md-2 control-label">酒量c.c.</label>

                    <div class="col-md-10"><input type="number" name="cc_wineq" class="input-sm"
                                                  value="{{ old('cc_wineq') }}">c.c./天
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_smoke" class="col-md-2 control-label">有无抽烟</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smoke" id="cc_smoke0"
                                                           checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smoke"
                                                           id="cc_smoke1">有</label>
                        <input type="text" name="cc_smoke_time" class="input-sm" value="{{ old('cc_smoke_time') }}">支/天
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_mh" class="col-md-2 control-label">疾病史</label>

                    <div class="col-md-10"><input type="text" name="cc_mh" class="input-sm" value="{{ old('cc_mh') }}" placeholder="诊断码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_fh" class="col-md-2 control-label">家族病史</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_fh" id="cc_fh0"
                                                           checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_fh" id="cc_fh1">有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_fh_desc" class="col-md-2 control-label">上列病史</label>

                    <div class="col-md-10"><input type="text" name="cc_fh_desc" class="input-sm"
                                                  value="{{ old('cc_fh_desc') }}" placeholder="备注描述">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_drug_allergy" class="col-md-2 control-label">药物过敏</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_drug_allergy"
                                                           id="cc_drug_allergy0" checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_drug_allergy"
                                                           id="cc_drug_allergy1">有</label>
                        <input type="text" name="cc_drug_allergy_name" class="input-sm"
                               value="{{ old('cc_drug_allergy_name') }}" placeholder="对何种药物名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_activity" class="col-md-2 control-label">活动量</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_activity" id="cc_activity0">非劳动/卧床</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_activity" id="cc_activity1"
                                                           checked>轻度</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_activity" id="cc_activity2">中度</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_activity" id="cc_activity3">重度</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_medicaretype" class="col-md-2 control-label">医保类型</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_medicaretype"
                                                           id="cc_medicaretype0">省医保</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_medicaretype"
                                                           id="cc_medicaretype1" checked>市医保</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_medicaretype"
                                                           id="cc_medicaretype2">哈尔滨市城镇居民医保</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_medicaretype"
                                                           id="cc_medicaretype3">省农村合作医疗</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_medicaretype"
                                                           id="cc_medicaretype4">省医保公务员</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_medicaretype"
                                                           id="cc_medicaretype5">市医保公务员</label>
                        <label class="radio-inline"><input type="radio" value="6" name="cc_medicaretype"
                                                           id="cc_medicaretype6">自费</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_jobtime" class="col-md-2 control-label">工作时间</label>

                    <div class="col-md-4">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_jobtime" id="cc_jobtime0"
                                                           checked>固定</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_jobtime" id="cc_jobtime1">轮班</label>
                    </div>
                </div>
                <div class="row">
                    <label for="cc_current_use" class="col-md-2 control-label">目前治疗方式</label>

                    <div class="col-md-10" id="cccurrent">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_current_use" id="cc_current0" checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_current_use" id="cc_current1">有：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use1" id="cc_current_use1" disabled="disabled">口服药</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use2" id="cc_current_use2" disabled="disabled">胰岛素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use3" id="cc_current_use3" disabled="disabled">饮食控制</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use4" id="cc_current_use4" disabled="disabled">中药治疗</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use5" id="cc_current_use5" disabled="disabled">以上方式有持续<span class="text-danger">规则治疗</span></label>
                        <label class="checkbox-inline">开始年月
                            <select name="cc_starty" class="input-sm" id="cc_starty" disabled="disabled">
                                <option value="-1">不详</option>
                                @for ($i = $year; $i > 1910; $i--)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>年
                            <select name="cc_startm" class="input-sm" id="cc_startm" disabled="disabled">
                                <option value="-1">不详</option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>月
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_hinder">影响学习之因素</label>

                    <div class="col-md-10" id="cchinder">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_hinder" id="cc_hinder0" checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_hinder" id="cc_hinder1">有：</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_1" id="cc_hinder_1" disabled="disabled">失聪</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_2" id="cc_hinder_2" disabled="disabled">失明</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_3" id="cc_hinder_3" disabled="disabled">手部不灵活</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_4" id="cc_hinder_4" disabled="disabled">听力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_5" id="cc_hinder_5" disabled="disabled">视力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_6" id="cc_hinder_6" disabled="disabled">智力障碍</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_7" id="cc_hinder_7" disabled="disabled">情绪因素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_8" id="cc_hinder_8" disabled="disabled">疾病因素</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder_9" id="cc_hinder_9" disabled="disabled">其他</label>
                        <label class="checkbox-inline">简略说明：<input class="input-sm" type="text" name="cc_hinder_desc" id="cc_hinder_desc" value="{{ old('cc_hinder_desc') }}" placeholder="20字内" disabled="disabled"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_act_time_sel" class="col-md-2 control-label">运动次数</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_act_time_sel"
                                                           id="cc_act_time_sel0" checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_act_time_sel"
                                                           id="cc_act_time_sel1">有</label>
                        <label class="radio-inline"><input class="input-sm" type="text" name="cc_act_time"
                                                           value="{{ old('cc_act_time') }}">次/周</label>
                        <label class="radio-inline">运动时间：<input class="input-sm" type="text" name="cc_act_times"
                                                           value="{{ old('cc_act_times') }}">分钟/次</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_act_kind">运动种类</label>

                    <div class="col-md-10">
                        <select name="cc_act_kind" class="input-sm">
                            @foreach($actkind as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="cc_act_other" id="cc_act_other" class="input-sm" value="{{ old('cc_act_other') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_edu" class="col-md-2 control-label">教育程度</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_edu" id="cc_edu0">不识字</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_edu" id="cc_edu1">识数字</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_edu" id="cc_edu2">识字</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_edu"
                                                           id="cc_edu3">日本教育</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_edu" id="cc_edu4">国小</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_edu" id="cc_edu5">国中</label>
                        <label class="radio-inline"><input type="radio" value="6" name="cc_edu" id="cc_edu6" checked>高中</label>
                        <label class="radio-inline"><input type="radio" value="7" name="cc_edu" id="cc_edu7">大专</label>
                        <label class="radio-inline"><input type="radio" value="8" name="cc_edu" id="cc_edu8">大学</label>
                        <label class="radio-inline"><input type="radio" value="9" name="cc_edu" id="cc_edu9">硕士</label>
                        <label class="radio-inline"><input type="radio" value="10" name="cc_edu"
                                                           id="cc_edu10">博士</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc_careself" class="col-md-2 control-label">自我照顾</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_careself" id="cc_careself0">独居</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_careself" id="cc_careself1"
                                                           checked>完全独立</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_careself" id="cc_careself2">需旁人照顾</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_careself" id="cc_careself3">完全由旁人照顾</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_careself" id="cc_careself4">安养中心<input
                                    class="input-sm" type="text" name="cc_careself_name"
                                    value="{{ old('cc_careself_name') }}"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman">照顾者名称</label>

                    <div class="col-md-10"><input class="form-control input-sm" type="text" name="cc_careman"
                                                  value="{{ old('cc_careman') }}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_careman_tel">照顾者电话</label>

                    <div class="col-md-10"><input class="form-control input-sm" type="text" name="cc_careman_tel"
                                                  value="{{ old('cc_careman_tel') }}"></div>
                </div>
                <div class="row">
                    <label class="col-md-2 control-label" for="cc_usebsm">使用血糖仪</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm" id="cc_usebsm0"
                                                           checked>无</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm"
                                                           id="cc_usebsm1">有,</label>
                        <label class="radio-inline">厂牌或型号：
                            <select class="input-sm" name="cc_usebsm_name"
                                    onchange="if(this.value>0){cc_usebsm1.checked=true;cc_otherbsm.style.display='none'}else{cc_otherbsm.style.display='inline-block'}">
                                <option value="0">其他</option>
                                @foreach($bsms as $bsm)
                                    <option value="{{ $bsm->id }}">{{ $bsm->bm_name }}</option>
                                @endforeach
                            </select>
                            <input class="input-sm" type="text" name="cc_otherbsm" id="cc_otherbsm"
                                   value="{{ old('cc_otherbsm') }}" placeholder="请输入新厂牌或型号">
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_usebsm_frq">测试频率</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq0" checked><input class="input-sm"
                                                                                              type="text"
                                                                                              name="cc_usebsm_frq_week"
                                                                                              value="{{ old('cc_usebsm_frq_week') }}">次/周</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm_frq"
                                                           id="cc_usebsm_frq1"><input class="input-sm" type="text"
                                                                                      name="cc_usebsm_frq_month"
                                                                                      value="{{ old('cc_usebsm_frq_month') }}">次/月</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_g6pd">G6PD</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_g6pd" id="cc_g6pd0" checked>不详</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_g6pd" id="cc_g6pd1">无</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_g6pd" id="cc_g6pd2">有</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_deathdate">死亡</label>

                    <div class="col-md-10">
                        <select class="input-sm" name="cc_deathdate">
                            <option value="-1">不详</option>
                            @for ($i = $year; $i > 1999; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>年
                        <select class="input-sm" name="cc_deathdatem">
                            <option value="-1">不详</option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>月
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone">本人是否使用智能型手机</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone"
                                                           id="cc_smartphone0">否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone"
                                                           id="cc_smartphone1" checked>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_wifi3g">智能型手机上网功能</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_wifi3g" id="cc_wifi3g1">Wi-Fi</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_wifi3g" id="cc_wifi3g2"
                                                           checked>行动上网</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_smartphone_family">家属是否使用智能型手机</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone_family"
                                                           id="cc_smartphone_family0">否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone_family"
                                                           id="cc_smartphone_family1" checked>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_familyupload">家属可否协助传输血糖数值</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_familyupload"
                                                           id="cc_familyupload0">否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_familyupload"
                                                           id="cc_familyupload1" checked>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_uploadtodm">是否愿意将血糖数值传输回共照管理系统</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_uploadtodm"
                                                           id="cc_uploadtodm0">否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_uploadtodm"
                                                           id="cc_uploadtodm1" checked>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_appexp">是否安装过健康管理App软件</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="0" name="cc_appexp"
                                                           id="cc_appexp0">否</label>
                        <label class="radio-inline"><input type="radio" value="1" name="cc_appexp" id="cc_appexp1"
                                                           checked>是</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cc_lastexam">最近一次验血糖时间</label>

                    <div class="col-md-10">
                        <label class="radio-inline"><input type="radio" value="1" name="cc_lastexam" id="cc_lastexam1"
                                                           checked>一周内</label>
                        <label class="radio-inline"><input type="radio" value="2" name="cc_lastexam" id="cc_lastexam2">一个月内</label>
                        <label class="radio-inline"><input type="radio" value="3" name="cc_lastexam" id="cc_lastexam3">三个月内</label>
                        <label class="radio-inline"><input type="radio" value="4" name="cc_lastexam" id="cc_lastexam4">半年内</label>
                        <label class="radio-inline"><input type="radio" value="5" name="cc_lastexam" id="cc_lastexam5">半年以上</label>
                    </div>
                </div>

                <a class="btn btn-info" href="{{ route('patient.index') }}">历史纪录</a>
                <!-- a class="btn btn-default" href="{{-- route('patient.index') --}}">返回</a -->
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
            @else
                <h4></h4>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>[注意]</strong><br>{{ $err_msg }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/patient.js') !!}
@stop
