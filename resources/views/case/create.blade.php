@extends('master')

@section('title')
    方案资料-增
@stop

@section('css')
    {!! Html::style('css/case.css') !!}
@stop

@section('content')
    <div class="container">
        <div class="page-header hidden-print">
            <h3>方案资料 / 增</h3>
        </div>

        <div class="col-md-12">
            @include('errors.list')
            @if(is_null($err_msg))
            <form id="caseform" action="{{ route('case.store') }}" method="POST" role="form" data-toggle="validator">
                <div id="printpage">
                <input type="hidden" name="pp_id" value="{{ $patientprofiles->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="cl_patientname">患者名</label>
                    <input type="text" name="cl_patientname" id="cl_patientname" class="input-sm" size="5" value="{{ $patientprofiles->pp_name }}" readonly>
                    <label class="control-label" for="cl_patientid">患者ID</label>
                    <input type="text" name="cl_patientid" id="cl_patientid" class="input-sm" value="{{ $patientprofiles->pp_patientid }}" readonly>
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

                <table class="table table-bordered bg-warning" id="caseis1409" style="display: none">
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
                        <th><span class="text-danger">*</span>血压</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" name="cl_base_sbp" id="cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_sbp') }}" required> /
                                <input type="text" name="cl_base_ebp" id="cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_ebp') }}" required> mmhg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>足部检查 (右)</th>
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
                        <th><span class="text-danger">*</span>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_pulse" name="cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_pulse') }}" required> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>足部检查 (左)</th>
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
                        <th><span class="text-danger">*</span>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_tall" name="cl_base_tall" size="5" onblur="calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" pattern="^[0-9]{2,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="2" data-minlength-error="输入数字长度不足" value="{{ $patientprofiles->pp_height }}" required> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>溃疡 / 坏疽</th>
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
                        <th><span class="text-danger">*</span>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_weight" name="cl_base_weight" size="5" onblur="calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_base_weight') }}" required> kg
                                <input type="checkbox" name="cl_noweight" id="cl_noweight" value="1" onclick="clkweight(this.id)">无法测量
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th rowspan="2"><span class="text-danger">*</span>并发症</th>
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
                                其他<input type="text" id="cl_complications_other" name="cl_complications_other" size=10 tabindex="11" value="{{ old('cl_complications_other') }}">
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
                        <th><span class="text-danger">*</span>下肢间歇痛</th>
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
                        <th rowspan="2"><span class="text-danger">*</span>血糖</th>
                        <td rowspan="2">
                            <div class="form-group has-feedback">
                                <input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="0" tabindex="6" checked>早<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="1" tabindex="7" required>中<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="2" tabindex="7">晚&nbsp;
                                <input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="0" tabindex="6" checked>前<input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="1" tabindex="7">后<br>
                                <input type="text" id="cl_blood_acpc" name="cl_blood_acpc" size="5" tabindex="6" title="10~999" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_blood_acpc') }}" required> mg/dL
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
                        <th><span class="text-danger">*</span>A1C</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_blood_hba1c" name="cl_blood_hba1c" size="5" tabindex="7" title="3~25" pattern="^[0-9]{1,}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_blood_hba1c') }}" required> %
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>视网膜检查</th>
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
                                <input type="text" id="cl_tc" name="cl_tc" size="5" tabindex="38" title="50~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_tc') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>白內障</th>
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
                                <input type="text" id="cl_tg" name="cl_tg" size="5" tabindex="39" title="20~3000" pattern="^[0-9]{1,}$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_tg') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>心电图</th>
                        <td>
                            <div class="form-group has-feedback" id="clecg">
                                <input type="checkbox" name="cl_ecg" id="cl_ecg" value="1" tabindex="17">正常　异常
                                <select name="cl_ecg_item" id="cl_ecg_item" type="option" tabindex="17">
                                    <option value="">请选择</option>
                                    <option value="1">PVC</option>
                                    <option value="2">Af</option>
                                    <option value="3">NS-ST change</option>
                                    <option value="4">其他</option>
                                </select>
                                <input type="text" id="cl_ecg_other" name="cl_ecg_other" size=10 tabindex="17" value="{{ old('cl_ecg_other') }}">
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
                                <input type="text" id="cl_ldl" name="cl_ldl" size="5" tabindex="40" title="50~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ldl') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>冠心病</th>
                        <td>
                            <div class="form-group has-feedback" id="clcoronaryheart">
                                <input type="checkbox" name="cl_coronary_heart" id="cl_coronary_heart" value="1" tabindex="18">无　　异常
                                <select name="cl_coronary_heart_item" id="cl_coronary_heart_item" type="option" tabindex="18">
                                    <option value="">请选择</option>
                                    <option value="1">冠状动脉绕道术</option>
                                    <option value="2">支架</option>
                                    <option value="3">气球扩张术</option>
                                    <option value="4">其他</option>
                                </select>
                                <input type="text" id="cl_coronary_heart_other" name="cl_coronary_heart_other" size="10" tabindex="18" value="{{ old('cl_coronary_heart_other') }}">
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
                                <input type="text" id="cl_hdl" name="cl_hdl" size="5" tabindex="41" title="10~200" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_hdl') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>脑中风</th>
                        <td>
                            <div class="form-group has-feedback" id="clstroke">
                                <input type="checkbox" name="cl_stroke" id="cl_stroke" value="1" tabindex="19">无　　异常
                                <select name="cl_stroke_item" id="cl_stroke_item" type="option" tabindex="19">
                                    <option value="">请选择</option>
                                    <option value="1">梗塞性</option>
                                    <option value="2">出血性</option>
                                    <option value="3">其他</option>
                                </select>
                                <input type="text" id="cl_stroke_other" name="cl_stroke_other" size=10 tabindex="19" value="{{ old('cl_stroke_other') }}">
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
                                <input type="text" id="cl_alt" name="cl_alt" size="5" tabindex="42" title="5~2000" pattern="^[0-9]{1,}$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_alt') }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>失明</th>
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
                        <th>GGT</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ggt" name="cl_ggt" size="5" tabindex="43" title="0.1~20" min="0.1" max="20" step="any" pattern="^[0-9]{1,}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ggt') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>透析</th>
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
                        <th>肌酐</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_uricacid" name="cl_uricacid" size="5" tabindex="44" title="4~25" min="4" max="25" step="any" pattern="^[0-9]{1,}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_uricacid') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>下肢截肢</th>
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
                                <input type="text" id="cl_amputation_other" name="cl_amputation_other" size=10 tabindex="22" value="{{ old('cl_amputation_other') }}">
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
                        <th>UA</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ua" name="cl_ua" size="5" tabindex="45" title="4~25" pattern="^[0-9]{1,}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_ua') }}"> mg/dL
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>高低血糖就医</th>
                        <td>
                            <div class="form-group has-feedback" id="clmedicaltreatment">
                                <input type="checkbox" name="cl_medical_treatment" id="cl_medical_treatment" value="1" tabindex="23">无
                                有：<input type="text" id="cl_medical_treatment_other" name="cl_medical_treatment_other" size=10 tabindex="23" value="{{ old('cl_medical_treatment_other') }}"> 次/月
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="1" tabindex="23">急诊
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="2" tabindex="23">住院
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>尿微</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_urine_micro" name="cl_urine_micro" size="5" tabindex="46" title="0.1~2500" min="0.1" max="2500.00" step="any" pattern="^[0-9]{1,4}(\.[0-9]{0,2})?$" maxlength="7" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_urine_micro') }}"> mg/g
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>饮酒</th>
                        <td>
                            <div class="form-group has-feedback" id="cldrinking">
                                <input type="checkbox" name="cl_drinking" id="cl_drinking" value="1" tabindex="24">无
                                有：<input type="text" id="cl_drinking_other" name="cl_drinking_other" size=10 tabindex="24" value="{{ old('cl_drinking_other') }}"> c.c/周
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>尿蛋白</th>
                        <td>
                            <div class="form-group" id="clurineroutine">
                                <select name="cl_urine_routine" id="cl_urine_routine" type="option" tabindex="47">
                                    <option value="">请选择</option>
                                    <option value="1" selected>正常</option>
                                    <option value="2">+</option>
                                    <option value="3">++</option>
                                    <option value="4">+++</option>
                                    <option value="5">++++</option>
                                </select>
                            </div>
                        </td>
                        <th><span class="text-danger">*</span>抽烟</th>
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
                        <th>eGFR</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_egfr" name="cl_egfr" size="5" tabindex="48" title="1~500" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('cl_egfr') }}"> ml/min/1.73m<sup>2</sup>
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
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>咀嚼功能</th>
                        <td>
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="0" tabindex="27">正常
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="1" tabindex="27">异常
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>彩超</th>
                        <td>
                            <input type="radio" name="cl_ultrasound" id="cl_ultrasound" value="0" tabindex="28">无
                            <input type="radio" name="cl_ultrasound" id="cl_ultrasound" value="1" tabindex="28">有
                            <input type="radio" name="cl_ultrasound" id="cl_ultrasound" value="2" tabindex="28">不详
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered bg-success" id="casegeneral1408" style="display: none">
                    <thead>
                    <tr>
                        <th class="text-center" width="15%">评估项目</th>
                        <th class="text-center" width="85%">结 果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><span class="text-danger">*</span>血压</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_sbp" name="_cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_sbp') }}" required> /&nbsp;
                                <input type="text" id="_cl_base_ebp" name="_cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_ebp') }}" required> mmHg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="text-danger">*</span>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_pulse" name="_cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_pulse') }}" required> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="text-danger">*</span>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_tall" name="_cl_base_tall" size="5" onblur="_calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" pattern="^[0-9]{2,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="2" data-minlength-error="输入数字长度不足" value="{{ $patientprofiles->pp_height }}" required> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><span class="text-danger">*</span>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_weight" name="_cl_base_weight" size="5" onblur="_calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_base_weight') }}" required> kg　
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
                        <th><span class="text-danger">*</span>血糖</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="0" tabindex="5" checked>早<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="1" tabindex="5">中<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="2" tabindex="5">晚&nbsp;
                                <input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="0" tabindex="5" checked>前<input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="1" tabindex="5">后
                                <input type="text" id="_cl_blood_acpc" name="_cl_blood_acpc" size="5" tabindex="5" title="10~999" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ old('_cl_blood_acpc') }}" required> mg/dL
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
                                <input type="text" name="_cl_quitsmoke" id="_cl_quitsmoke" size=10 tabindex="6" value="{{ old('_cl_quitsmoke') }}">
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
            @endif
        </div>
    </div>
@endsection

@section('loadScripts')
    {!! Html::script('js/case.js') !!}
@stop
