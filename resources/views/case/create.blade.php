@extends('master')

@section('title')
    方案资料-增
@stop

@section('activec')
active
@stop

@section('css')
    {!! Html::style('css/case.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header hidden-print">
            <h3>方案资料 / 增</h3>
        </div>

        <div class="col-md-12">
            @include('errors.list')
            @if(is_null($err_msg))
            <form id="caseform" action="{{ route('case.store') }}" method="POST" role="form" data-toggle="validator">
                <div id="printpage">
                <input type="hidden" name="pp_id" value="{{ $patientprofiles->id }}">
                <input type="hidden" name="user_id" value="{{ $uid }}">
                <input type="hidden" name="educator_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="cl_patientname">患者名</label>
                    <input type="text" name="cl_patientname" id="cl_patientname" class="input-sm" size="5" value="{{ $ppname }}" readonly>
                    <label class="control-label" for="cl_patientid">患者ID</label>
                    <input type="text" name="cl_patientid" id="cl_patientid" class="input-sm" value="{{ $patientid }}" readonly>
                    <label class="control-label" for="cl_case_date">收案日</label>
                    <input type="text" name="cl_case_date" id="cl_case_date" class="input-sm datepicker" size="8" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $today }}">
                    <label class="control-label" for="cl_case_educator">卫教师</label>
                    <input type="text" name="cl_case_educator" id="cl_case_educator" class="input-sm" size="5" value="{{ Auth::user()->name }}" readonly>
                    <label class="control-label" for="cl_case_type">方案种类</label>
                    <select name="cl_case_type" id="cl_case_type" class="input-sm" onchange="updateTxtContent(this.value);" required>
                        @foreach($casetypes as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <table class="table table-bordered" id="caseis1409" style="display: none">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%">评估项目</th>
                        <th class="text-center" width="24%">结 果</th>
                        <th class="text-center" width="10%">评估项目</th>
                        <th class="text-center">结 果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>血压</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" name="cl_base_sbp" id="cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_sbp') }}"> /
                                <input type="text" name="cl_base_ebp" id="cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_ebp') }}"> mmhg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>足部检查 (右)</th>
                        <td>
                            <div class="form-group has-feedback" id="clfootchkright">
                                <input type="checkbox" name="cl_foot_chk_right0" id="cl_foot_chk_right0" value="1" tabindex="8">正常
                                <input type="checkbox" name="cl_foot_chk_right1" id="cl_foot_chk_right1" value="1" tabindex="8">音叉
                                <input type="checkbox" name="cl_foot_chk_right2" id="cl_foot_chk_right2" value="1" tabindex="8">尼龙丝
                                <input type="checkbox" name="cl_foot_chk_right3" id="cl_foot_chk_right3" value="1" tabindex="8">脉搏
                                <input type="checkbox" name="cl_foot_chk_right4" id="cl_foot_chk_right4" value="1" tabindex="8">搭桥
                                <input type="checkbox" name="cl_foot_chk_right5" id="cl_foot_chk_right5" value="1" tabindex="8">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_pulse" name="cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_pulse') }}"> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>足部检查 (左)</th>
                        <td>
                            <div class="form-group has-feedback" id="clfootchkleft">
                                <input type="checkbox" name="cl_foot_chk_left0" id="cl_foot_chk_left0" value="1" tabindex="9">正常
                                <input type="checkbox" name="cl_foot_chk_left1" id="cl_foot_chk_left1" value="1" tabindex="9">音叉
                                <input type="checkbox" name="cl_foot_chk_left2" id="cl_foot_chk_left2" value="1" tabindex="9">尼龙丝
                                <input type="checkbox" name="cl_foot_chk_left3" id="cl_foot_chk_left3" value="1" tabindex="9">脉搏
                                <input type="checkbox" name="cl_foot_chk_left4" id="cl_foot_chk_left4" value="1" tabindex="9">搭桥
                                <input type="checkbox" name="cl_foot_chk_left5" id="cl_foot_chk_left5" value="1" tabindex="9">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_tall" name="cl_base_tall" size="5" onblur="calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" pattern="^[0-9]{2,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="2" data-minlength-error="输入数字长度不足" value="{{ $patientprofiles->pp_height }}"> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>溃疡 / 坏疽</th>
                        <td>
                            <div class="form-group has-feedback" id="clulcers">
                                <input type="checkbox" name="cl_ulcers" id="cl_ulcers" value="1" tabindex="10">无&nbsp;
                                有(<input type="checkbox" name="cl_ulcers_right" id="cl_ulcers_right" value="1" tabindex="10">右/<input type="checkbox" name="cl_ulcers_left" id="cl_ulcers_left" value="1" tabindex="10">左)
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_weight" name="cl_base_weight" size="5" onblur="calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_weight') }}"> kg
                                <input type="checkbox" name="cl_noweight" id="cl_noweight" value="1" onclick="clkweight(this.id)">无法测量
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th rowspan="2">并发症</th>
                        <td rowspan="2">
                            <div class="form-group has-feedback" id="clcomplications">
                                <input type="checkbox" name="cl_complications0" id="cl_complications0" value="1" tabindex="11">无　　肾病变: stage
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage1" value="1" tabindex="11">1
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage2" value="2" tabindex="11">2
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage3" value="3" tabindex="11">3a
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage4" value="4" tabindex="11">3b
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage5" value="5" tabindex="11">4
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage6" value="6" tabindex="11">5<br>
                        　　　　<input type="checkbox" name="cl_complications1" id="cl_complications1" value="1" tabindex="11">神经病变
                                <input type="checkbox" name="cl_complications2" id="cl_complications2" value="1" tabindex="11">周边血管病变
                                其他<input type="text" id="cl_complications_other" name="cl_complications_other" size="10" tabindex="11" value="{{ old('cl_complications_other') }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>IBW / BMI</th>
                        <td>
                            <input type="text" id="cl_ibw" name="cl_ibw" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ old('cl_ibw') }}" readonly> kg/
                            <input type="text" id="cl_bmi" name="cl_bmi" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ old('cl_bmi') }}" readonly> kg/m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <th>腰 / 臀围</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_waist" name="cl_waist" size="5" tabindex="5" title="20~200" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_waist') }}"> cm/
                                <input type="text" id="cl_hips" name="cl_hips" size="5" tabindex="5" title="20~200" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_hips') }}"> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>下肢间歇痛</th>
                        <td>
                            <div class="form-group has-feedback" id="clintermittentpain">
                                <input type="checkbox" name="cl_intermittentpain" id="cl_intermittentpain" value="1" tabindex="12">无　　有
                                <input type="checkbox" name="cl_intermittentpain_right" id="cl_intermittentpain_right" value="1" tabindex="12">右
                                <input type="checkbox" name="cl_intermittentpain_left" id="cl_intermittentpain_left" value="1" tabindex="12">左
                                <input type="checkbox" name="cl_intermittentpain_no" id="cl_intermittentpain_no" value="1" tabindex="12">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2">血糖</th>
                        <td rowspan="2">
                            <div class="form-group has-feedback">
                                <input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="0" tabindex="6" checked>早<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="1" tabindex="7">中<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="2" tabindex="7">晚&nbsp;
                                <input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="0" tabindex="6" checked>前<input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="1" tabindex="7">后<br>
                                <input type="text" id="cl_blood_acpc" name="cl_blood_acpc" size="5" tabindex="6" title="10~999" min="10.0" max="999.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_blood_acpc') }}"> mmol/l
                                <input type="text" id="cl_blood_mins" name="cl_blood_mins" size="5" tabindex="6" disabled> 分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>ABI</th>
                        <td>
                            <div class="form-group" id="clabi">
                                <input type="checkbox" name="cl_abi" id="cl_abi" value="1" tabindex="13">正常　异常
                                <input type="checkbox" name="cl_abi_right" id="cl_abi_right" value="1" tabindex="13">右
                                <input type="text" id="cl_abi_right_value" name="cl_abi_right_value" size=4 tabindex="13" value="{{ old('cl_abi_right_value') }}">
                                <input type="checkbox" name="cl_abi_left" id="cl_abi_left" value="1" tabindex="13">左
                                <input type="text" id="cl_abi_left_value" name="cl_abi_left_value" size=4 tabindex="13" value="{{ old('cl_abi_left_value') }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>CAVI</th>
                        <td>
                            <div class="form-group" id="clcavi">
                                <input type="checkbox" name="cl_cavi" id="cl_cavi" value="1" tabindex="14">正常　异常
                                <input type="checkbox" name="cl_cavi_right" id="cl_cavi_right" value="1" tabindex="14">右
                                <input type="text" id="cl_cavi_right_value" name="cl_cavi_right_value" size="4" tabindex="14" value="{{ old('cl_cavi_right_value') }}">
                                <input type="checkbox" name="cl_cavi_left" id="cl_cavi_left" value="1" tabindex="14">左
                                <input type="text" id="cl_cavi_left_value" name="cl_cavi_left_value" size="4" tabindex="14" value="{{ old('cl_cavi_left_value') }}">　R-Kcavi
                                <input type="text" id="cl_cavi_rkcavi" name="cl_cavi_rkcavi" size="4" tabindex="14" value="{{ old('cl_cavi_rkcavi') }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>A1C</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_blood_hba1c" name="cl_blood_hba1c" size="5" tabindex="7" title="3~25" min="3.0" max="25.0" step="any"  pattern="^[0-9]{1,2}(\.[0-9]{0,1})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_blood_hba1c') }}"> %
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>视网膜检查</th>
                        <td>
                            <div class="form-group has-feedback" id="cleyechk8">
                                <input type="checkbox" name="cl_eye_chk8" id="cl_eye_chk8" value="1" tabindex="15">正常　异常
                                <input type="checkbox" name="cl_eye_chk8_right" id="cl_eye_chk8_right" value="1" tabindex="15">右
                                <select name="cl_eye_chk8_right_item" id="cl_eye_chk8_right_item" type="option" tabindex="15">
                                    <option value="">请选择</option>
                                    <option value="1">第I期</option>
                                    <option value="2">第II期</option>
                                    <option value="3">第III期</option>
                                    <option value="4">第IV期</option>
                                    <option value="5">第V期</option>
                                    <option value="6">第VI期</option>
                                </select>
                                <input type="checkbox" name="cl_eye_chk8_left" id="cl_eye_chk8_left" value="1" tabindex="15">左
                                <select name="cl_eye_chk8_left_item" id="cl_eye_chk8_left_item" type="option" tabindex="15">
                                    <option value="">请选择</option>
                                    <option value="1">第I期</option>
                                    <option value="2">第II期</option>
                                    <option value="3">第III期</option>
                                    <option value="4">第IV期</option>
                                    <option value="5">第V期</option>
                                    <option value="6">第VI期</option>
                                </select>
                                <input type="checkbox" name="cl_eye_chk8_no" id="cl_eye_chk8_no" value="1" tabindex="15">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>TC</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_tc" name="cl_tc" size="5" tabindex="38" title="0~6.19" min="0.00" max="6.19" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_tc') }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>白內障</th>
                        <td>
                            <div class="form-group has-feedback" id="clcataract">
                                <input type="checkbox" name="cl_cataract" id="cl_cataract" value="1" tabindex="16">无　　有
                                <input type="checkbox" name="cl_cataract_right" id="cl_cataract_right" value="1" tabindex="16">右
                                <input type="checkbox" name="cl_cataract_left" id="cl_cataract_left" value="1" tabindex="16">左
                                <input type="checkbox" name="cl_cataract_no" id="cl_cataract_no" value="1" tabindex="16">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>TG</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_tg" name="cl_tg" size="5" tabindex="39" title="0.4~1.86" min="0.40" max="1.86" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_tg') }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>心电图</th>
                        <td>
                            <div class="form-group has-feedback" id="clecg">
                                <input type="checkbox" name="cl_ecg" id="cl_ecg" value="1" tabindex="17">正常　异常
                                <input type="text" id="cl_ecg_other" name="cl_ecg_other" size="10" tabindex="17" value="{{ old('cl_ecg_other') }}">
                                <input type="checkbox" name="cl_ecg_no" id="cl_ecg_no" value="1" tabindex="17">未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>LDL</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ldl" name="cl_ldl" size="5" tabindex="40" title="2.07~3.10" min="2.07" max="3.10" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ldl') }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>冠心病</th>
                        <td>
                            <div class="form-group has-feedback" id="clcoronaryheart">
                                <input type="checkbox" name="cl_coronary_heart" id="cl_coronary_heart" value="1" tabindex="18">无　　异常
                                <input type="text" id="cl_coronary_heart_other" name="cl_coronary_heart_other" size="20" tabindex="18" value="{{ old('cl_coronary_heart_other') }}">
                                <select class="input-sm" name="cl_chh_year">
                                    <option value="-1">不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_chh_month">
                                    <option value="-1">不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>月
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>HDL</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_hdl" name="cl_hdl" size="5" tabindex="41" title="1.2~1.68" min="1.20" max="1.68" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_hdl') }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>脑中风</th>
                        <td>
                            <div class="form-group has-feedback" id="clstroke">
                                <input type="checkbox" name="cl_stroke" id="cl_stroke" value="1" tabindex="19">无　　异常
                                <select name="cl_stroke_item" id="cl_stroke_item" type="option" tabindex="19">
                                    <option value="">请选择</option>
                                    <option value="1">梗塞性</option>
                                    <option value="2">出血性</option>
                                    <option value="3">其他</option>
                                </select>
                                <input type="text" id="cl_stroke_other" name="cl_stroke_other" size="10" tabindex="19" value="{{ old('cl_stroke_other') }}">
                                <select class="input-sm" name="cl_sh_year">
                                    <option value="-1">不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_sh_month">
                                    <option value="-1">不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>月
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ALT</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_alt" name="cl_alt" size="5" tabindex="42" title="0~40" min="0" max="40" step="any" pattern="^[0-9]{1,2}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_alt') }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>失明</th>
                        <td>
                            <div class="form-group has-feedback" id="clblindness">
                                <input type="checkbox" name="cl_blindness" id="cl_blindness" value="1" tabindex="20">无
                                有：<input type="checkbox" name="cl_blindness_right" id="cl_blindness_right" value="1" tabindex="20">右
                                <select name="cl_blindness_right_item" id="cl_blindness_right_item" type="option" tabindex="20">
                                    <option value="">请选择</option>
                                    <option value="1">糖尿病</option>
                                    <option value="2">非糖尿病</option>
                                </select>
                                <input type="checkbox" name="cl_blindness_left" id="cl_blindness_left" value="1" tabindex="20">左
                                <select name="cl_blindness_left_item" id="cl_blindness_left_item" type="option" tabindex="20">
                                    <option value="">请选择</option>
                                    <option value="1">糖尿病</option>
                                    <option value="2">非糖尿病</option>
                                </select>
                                <select class="input-sm" name="cl_bh_year">
                                    <option value="-1">不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_bh_month">
                                    <option value="-1">不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>月
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>AST</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ast" name="cl_ast" size="5" tabindex="43" title="0~40" min="0" max="40" step="any" pattern="^[0-9]{1,2}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ast') }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>透析</th>
                        <td>
                            <div class="form-group has-feedback" id="cldialysis">
                                <input type="checkbox" name="cl_dialysis" id="cl_dialysis" value="1" tabindex="21">无
                                有：<select name="cl_dialysis_item" id="cl_dialysis_item" type="option" tabindex="21">
                                    <option value="">请选择</option>
                                    <option value="1">血液透析</option>
                                    <option value="2">腹膜透析</option>
                                </select>
                                <select class="input-sm" name="cl_dh_year">
                                    <option value="-1">不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_dh_month">
                                    <option value="-1">不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>月
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ALP</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_alp" name="cl_alp" size="5" tabindex="44" title="40~150" min="40" max="150" step="any" pattern="^[0-9]{1,3}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_alp') }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>下肢截肢</th>
                        <td>
                            <div class="form-group has-feedback" id="clamputation">
                                <input type="checkbox" name="cl_amputation" id="cl_amputation" value="1" tabindex="22">无
                                有：<input type="checkbox" name="cl_amputation_right" id="cl_amputation_right" value="1" tabindex="22">右
                                <select name="cl_amputation_right_item" id="cl_amputation_right_item" type="option" tabindex="22">
                                    <option value="">请选择</option>
                                    <option value="1">糖尿病</option>
                                    <option value="2">非糖尿病</option>
                                </select>
                                <input type="checkbox" name="cl_amputation_left" id="cl_amputation_left" value="1" tabindex="22">左
                                <select name="cl_amputation_left_item" id="cl_amputation_left_item" type="option" tabindex="22">
                                    <option value="">请选择</option>
                                    <option value="1">糖尿病</option>
                                    <option value="2">非糖尿病</option>
                                </select>
                                <input type="text" id="cl_amputation_other" name="cl_amputation_other" size="10" tabindex="22" value="{{ old('cl_amputation_other') }}">
                                <select class="input-sm" name="cl_ah_year">
                                    <option value="-1">不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_ah_month">
                                    <option value="-1">不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>月
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>GGT</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ggt" name="cl_ggt" size="5" tabindex="45" title="11~61" min="11" max="61" step="any" pattern="^[0-9]{1,2}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ggt') }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>高低血糖就医</th>
                        <td>
                            <div class="form-group has-feedback" id="clmedicaltreatment">
                                <input type="checkbox" name="cl_medical_treatment" id="cl_medical_treatment" value="1" tabindex="23">无
                                有：<input type="text" id="cl_medical_treatment_other" name="cl_medical_treatment_other" size="10" tabindex="23" value="{{ old('cl_medical_treatment_other') }}"> 次/月
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="1" tabindex="23">急诊
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="2" tabindex="23">住院
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>肌酐</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_uricacid" name="cl_uricacid" size="5" tabindex="46" title="40~97" min="40" max="97" step="any" pattern="^[0-9]{1,3}?$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_uricacid') }}" onblur="calceGFR(this.value, {{ $sex }}, {{ $patientprofiles->pp_patientid }})"> μmol/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>饮酒</th>
                        <td>
                            <div class="form-group has-feedback" id="cldrinking">
                                <input type="checkbox" name="cl_drinking" id="cl_drinking" value="1" tabindex="24">无
                                有：<input type="text" id="cl_drinking_other" name="cl_drinking_other" size="10" tabindex="24" value="{{ old('cl_drinking_other') }}"> c.c/周
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>UA</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ua" name="cl_ua" size="5" tabindex="47" title="155~428" min="155.0" max="428.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ua') }}"> μmol/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>抽烟</th>
                        <td>
                            <div class="form-group has-feedback" id="clsmoking">
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="0" tabindex="25">无
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="1" tabindex="25">有
                                <input type="text" name="cl_havesmoke" id="cl_havesmoke" size="3" tabindex="25" value="{{ old('cl_havesmoke') }}">支
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="2" tabindex="25">已戒
                                <input type="text" name="cl_quitsmoke" id="cl_quitsmoke" size="10" tabindex="25" value="{{ old('cl_quitsmoke') }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>尿微</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_urine_micro" name="cl_urine_micro" size="5" tabindex="48" title="0~30" min="0" max="30" step="any" pattern="^[0-9]{1,3}?$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_urine_micro') }}"> mg/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>牙周病变</th>
                        <td>
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="0" tabindex="26">无
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="1" tabindex="26">有
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="2" tabindex="26">不详
                        </td>
                    </tr>
                    <tr>
                        <th>尿蛋白</th>
                        <td>
                            <div class="form-group" id="clurineroutine">
                                <select name="cl_urine_routine" id="cl_urine_routine" type="option" tabindex="49">
                                    <option value="">请选择</option>
                                    <option value="1" selected>正常</option>
                                    <option value="2">+</option>
                                    <option value="3">++</option>
                                    <option value="4">+++</option>
                                    <option value="5">++++</option>
                                </select>
                            </div>
                        </td>
                        <th>咀嚼功能</th>
                        <td>
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="0" tabindex="27">正常
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="1" tabindex="27">异常
                        </td>
                    </tr>
                    <tr>
                        <th>尿酮</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ket" name="cl_ket" size="5" tabindex="50" title="0.5~1.0" min="0.5" max="1.0" step="any" pattern="^[0-9]{0,1}(\.[0-9]{0,1})?$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ket') }}"> mmol/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>彩超</th>
                        <td>
                            <input type="checkbox" name="cl_ultrasound0" id="cl_ultrasound0" value="1" tabindex="28">无<br>有，如下：<br>
                            <input type="checkbox" name="cl_ultrasound1" id="cl_ultrasound1" value="1" tabindex="28">双下肢
                            <input type="text" id="cl_ultrasound01" name="cl_ultrasound01" size="20" tabindex="28" value="{{ old('cl_ultrasound01') }}"><br>
                            <input type="checkbox" name="cl_ultrasound2" id="cl_ultrasound2" value="1" tabindex="28">心脏
                            <input type="text" id="cl_ultrasound02" name="cl_ultrasound02" size="20" tabindex="28" value="{{ old('cl_ultrasound02') }}"><br>
                            <input type="checkbox" name="cl_ultrasound3" id="cl_ultrasound3" value="1" tabindex="28">颈部
                            <input type="text" id="cl_ultrasound03" name="cl_ultrasound03" size="20" tabindex="28" value="{{ old('cl_ultrasound03') }}"><br>
                            <input type="checkbox" name="cl_ultrasound4" id="cl_ultrasound4" value="1" tabindex="28">消化
                            <input type="text" id="cl_ultrasound04" name="cl_ultrasound04" size="20" tabindex="28" value="{{ old('cl_ultrasound04') }}"><br>
                            <input type="checkbox" name="cl_ultrasound5" id="cl_ultrasound5" value="1" tabindex="28">泌尿
                            <input type="text" id="cl_ultrasound05" name="cl_ultrasound05" size="20" tabindex="28" value="{{ old('cl_ultrasound05') }}"><br>
                            <input type="checkbox" name="cl_ultrasound6" id="cl_ultrasound6" value="1" tabindex="28">甲状腺
                            <input type="text" id="cl_ultrasound06" name="cl_ultrasound06" size="20" tabindex="28" value="{{ old('cl_ultrasound06') }}"><br>
                            <input type="checkbox" name="cl_ultrasound7" id="cl_ultrasound7" value="1" tabindex="28">妇科
                            <input type="text" id="cl_ultrasound07" name="cl_ultrasound07" size="20" tabindex="28" value="{{ old('cl_ultrasound07') }}">
                        </td>
                    </tr>
                    <tr>
                        <th>eGFR</th>
                        <td>
                            <div class="form-group">
                                <input type="text" id="cl_egfr" name="cl_egfr" style="background-color:#CCCCCC" size="5" tabindex="51" title="1~500" min="1.00" max="500.00" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,2})?$" maxlength="6" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_egfr') }}" readonly> ml/min/1.73m<sup>2</sup>
                            </div>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" id="casegeneral1408" style="display: none">
                    <thead>
                    <tr>
                        <th class="text-center" width="15%">评估项目</th>
                        <th class="text-center" width="85%">结 果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>血压</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_sbp" name="_cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_sbp') }}"> /&nbsp;
                                <input type="text" id="_cl_base_ebp" name="_cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_ebp') }}"> mmHg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_pulse" name="_cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_pulse') }}"> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_tall" name="_cl_base_tall" size="5" onblur="_calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" pattern="^[0-9]{2,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="2" data-minlength-error="输入数字长度不足" value="{{ $patientprofiles->pp_height }}"> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_weight" name="_cl_base_weight" size="5" onblur="_calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_weight') }}"> kg　
                                <input type="checkbox" name="_cl_noweight" id="_cl_noweight" value="1" onclick="_clkweight(this.id)">无法测量　　
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>IBW / BMI</th>
                        <td>
                            <input type="text" id="_cl_ibw" name="_cl_ibw" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ old('_cl_ibw') }}" readonly> kg/
                            <input type="text" id="_cl_bmi" name="_cl_bmi" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ old('_cl_bmi') }}" readonly> kg/m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <th>血糖</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="0" tabindex="5" checked>早<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="1" tabindex="5">中<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="2" tabindex="5">晚&nbsp;
                                <input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="0" tabindex="5" checked>前<input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="1" tabindex="5">后
                                <input type="text" id="_cl_blood_acpc" name="_cl_blood_acpc" size="5" tabindex="5" title="10~999" min="10.0" max="999.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_blood_acpc') }}"> mmol/l
                                <input type="text" id="_cl_blood_mins" name="_cl_blood_mins" size="5" tabindex="5" disabled> 分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>抽烟</th>
                        <td>
                            <div class="form-group has-feedback" id="_clsmoking">
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="0" tabindex="6">无　　
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="1" tabindex="6">有
                                <input type="text" name="_cl_havesmoke" id="_cl_havesmoke" size=3 tabindex="6" value="{{ old('_cl_havesmoke') }}">支
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="2" tabindex="6">已戒
                                <input type="text" name="_cl_quitsmoke" id="_cl_quitsmoke" size="10" tabindex="6" value="{{ old('_cl_quitsmoke') }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <div class="hidden-print">
                    <!-- a class="btn btn-default" href="{{-- route('case.index') --}}">返回</a -->
                    <a class="btn btn-info" href="{{ route('case.index') }}">历史纪录</a>
                    <button class="btn btn-primary" type="submit">保存</button>
                    <button class="btn btn-default" type="button" onclick="printdiv()">打印</button>
                </div>
            </form>
            @else
                <h4></h4>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>[注意]</strong><br>{!! $err_msg !!}
                </div>
                <a class="btn btn-info" href="{{ route('case.index') }}">历史纪录</a>
            @endif
        </div>
    </div>
@endsection

@section('loadScripts')
    {!! Html::script('js/case.js') !!}
@stop
