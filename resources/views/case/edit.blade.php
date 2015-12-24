@extends('master')

@section('title')
    方案资料-改
@stop

@section('activec')
    <li class=""><a href="/patient">患者资料</a></li>
    <li class=""><a href="/bdata/">血糖</a></li>
    <li class="active"><a href="/case">方案</a></li>
@stop

@section('css')
    {!! Html::style('css/case.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header hidden-print">
            <h3>方案资料 / 改</h3>
        </div>
        <div class="col-md-12">
            @include('errors.list')
            <form id="caseform" action="{{ route('case.update', $caselist->id) }}" method="POST" role="form" data-toggle="validator">
                <div id="printpage">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label" for="cl_patientname">患者名</label>
                    <input type="text" name="cl_patientname" id="cl_patientname" class="input-sm" size="5" value="{{ $ppname }}" readonly>
                    <label class="control-label" for="cl_patientid">患者ID</label>
                    <input type="text" name="cl_patientid" id="cl_patientid" class="input-sm" value="{{ $patientid }}" readonly>
                    <label class="control-label" for="cl_case_date">收案日</label>
                    <input type="text" name="cl_case_date" id="cl_case_date" class="input-sm datepicker" size="7" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-date-clear-btn="true" data-date-today-highlight="true" data-date-today-btn="linked" data-date-language="zh-TW" value="{{ $caselist->cl_case_date }}">
                    <label class="control-label" for="cl_case_educator">卫教师</label>
                    <input type="text" name="cl_case_educator" id="cl_case_educator" class="input-sm" size="5" value="{{ \App\User::find($caselist->cl_case_educator)->name }}" readonly>
                    <label class="control-label" for="cl_case_type">方案种类</label>
                    <select name="cl_case_type" id="cl_case_type" class="input-sm">
                        @foreach($casetypes as $key => $value)
                            @if($key == $caselist->cl_case_type)
                            <option value="{{ $key }}" {!! "$key" == $caselist->cl_case_type ? "selected='selected'" : "" !!}>{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <hr>

                <table class="table table-bordered {{ $caselist->cl_case_type == 1 ? 'bg-warning' : ($caselist->cl_case_type == 2 ? 'bg-info' : 'bg-danger') }} id="caseis1409" {!! $caselist->cl_case_type!=4 ? '' : 'style="display: none"' !!}>
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
                                <input type="text" name="cl_base_sbp" id="cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_base_sbp }}" required> /
                                <input type="text" name="cl_base_ebp" id="cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_base_ebp }}" required> mmhg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>足部检查 (右)</th>
                        <td>
                            <div class="form-group has-feedback" id="clfootchkright">
                                <input type="checkbox" name="cl_foot_chk_right0" id="cl_foot_chk_right0" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',0,1)=='1' ? "checked='checked'" : ""}}>正常
                                <input type="checkbox" name="cl_foot_chk_right1" id="cl_foot_chk_right1" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',1,1)=='1' ? "checked='checked'" : ""}}>音叉
                                <input type="checkbox" name="cl_foot_chk_right2" id="cl_foot_chk_right2" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',2,1)=='1' ? "checked='checked'" : ""}}>尼龙丝
                                <input type="checkbox" name="cl_foot_chk_right3" id="cl_foot_chk_right3" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',3,1)=='1' ? "checked='checked'" : ""}}>脉搏
                                <input type="checkbox" name="cl_foot_chk_right4" id="cl_foot_chk_right4" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',4,1)=='1' ? "checked='checked'" : ""}}>搭桥
                                <input type="checkbox" name="cl_foot_chk_right5" id="cl_foot_chk_right5" value="1" tabindex="8" {{substr($caselist->cl_foot_chk_right.'000000',5,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_pulse" name="cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_pulse }}" required> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>足部检查 (左)</th>
                        <td>
                            <div class="form-group has-feedback" id="clfootchkleft">
                                <input type="checkbox" name="cl_foot_chk_left0" id="cl_foot_chk_left0" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',0,1)=='1' ? "checked='checked'" : ""}}>正常
                                <input type="checkbox" name="cl_foot_chk_left1" id="cl_foot_chk_left1" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',1,1)=='1' ? "checked='checked'" : ""}}>音叉
                                <input type="checkbox" name="cl_foot_chk_left2" id="cl_foot_chk_left2" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',2,1)=='1' ? "checked='checked'" : ""}}>尼龙丝
                                <input type="checkbox" name="cl_foot_chk_left3" id="cl_foot_chk_left3" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',3,1)=='1' ? "checked='checked'" : ""}}>脉搏
                                <input type="checkbox" name="cl_foot_chk_left4" id="cl_foot_chk_left4" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',4,1)=='1' ? "checked='checked'" : ""}}>搭桥
                                <input type="checkbox" name="cl_foot_chk_left5" id="cl_foot_chk_left5" value="1" tabindex="9" {{substr($caselist->cl_foot_chk_left.'000000',5,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_tall" name="cl_base_tall" size="5" onblur="calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" value="{{ $caselist->cl_base_tall }}" required> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>溃疡 / 坏疽</th>
                        <td>
                            <div class="form-group has-feedback" id="clulcers">
                                <input type="checkbox" name="cl_ulcers" id="cl_ulcers" value="1" tabindex="10" {{substr($caselist->cl_ulcers.'00000',0,1)=='1' ? "checked='checked'" : ""}}>无&nbsp;
                                有(<input type="checkbox" name="cl_ulcers_right" id="cl_ulcers_right" value="1" tabindex="10" {{substr($caselist->cl_ulcers.'000',1,1)=='1' ? "checked='checked'" : ""}}>右/<input type="checkbox" name="cl_ulcers_left" id="cl_ulcers_left" value="1" tabindex="10" {{substr($caselist->cl_ulcers.'000',2,1)=='1' ? "checked='checked'" : ""}}>左)
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_base_weight" name="cl_base_weight" size="5" onblur="calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" value="{{ $caselist->cl_base_weight }}" required> kg
                                <input type="checkbox" name="cl_noweight" id="cl_noweight" value="1" onclick="clkweight(this.id)" {{substr($caselist->cl_noweight.'0',0,1)=='1' ? "checked='checked'" : ""}}>无法测量
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th rowspan="2">并发症</th>
                        <td rowspan="2">
                            <div class="form-group has-feedback" id="clcomplications">
                                <input type="checkbox" name="cl_complications0" id="cl_complications0" value="1" tabindex="11" {{substr($caselist->cl_complications.'000',0,1)=='1' ? "checked='checked'" : ""}}>无　　肾病变: stage
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage1" value="1" tabindex="11" {{$caselist->cl_complications_stage==1 ? "checked='checked'" : ""}}>1
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage2" value="2" tabindex="11" {{$caselist->cl_complications_stage==2 ? "checked='checked'" : ""}}>2
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage3" value="3" tabindex="11" {{$caselist->cl_complications_stage==3 ? "checked='checked'" : ""}}>3a
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage4" value="4" tabindex="11" {{$caselist->cl_complications_stage==4 ? "checked='checked'" : ""}}>3b
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage5" value="5" tabindex="11" {{$caselist->cl_complications_stage==5 ? "checked='checked'" : ""}}>4
                                <input type="radio" name="cl_complications_stage" id="cl_complications_stage6" value="6" tabindex="11" {{$caselist->cl_complications_stage==6 ? "checked='checked'" : ""}}>5<br>
                        　　　　<input type="checkbox" name="cl_complications1" id="cl_complications1" value="1" tabindex="11" {{substr($caselist->cl_complications.'000',1,1)=='1' ? "checked='checked'" : ""}}>神经病变
                                <input type="checkbox" name="cl_complications2" id="cl_complications2" value="1" tabindex="11" {{substr($caselist->cl_complications.'000',2,1)=='1' ? "checked='checked'" : ""}}>周边血管病变
                                其他<input type="text" id="cl_complications_other" name="cl_complications_other" size="10" tabindex="11" value="{{ $caselist->cl_complications_other }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>IBW / BMI</th>
                        <td>
                            <input type="text" id="cl_ibw" name="cl_ibw" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ $caselist->cl_ibw }}" readonly> kg/
                            <input type="text" id="cl_bmi" name="cl_bmi" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ $caselist->cl_bmi }}" readonly> kg/m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <th>腰 / 臀围</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_waist" name="cl_waist" size="5" tabindex="5" title="20~200" min="20.0" max="200.0" step="any" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_waist }}"> cm/
                                <input type="text" id="cl_hips" name="cl_hips" size="5" tabindex="5" title="20~200" min="20.0" max="200.0" step="any" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_hips }}"> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>下肢间歇痛</th>
                        <td>
                            <div class="form-group has-feedback" id="clintermittentpain">
                                <input type="checkbox" name="cl_intermittentpain" id="cl_intermittentpain" value="1" tabindex="12" {{substr($caselist->cl_intermittentpain.'0000',0,1)=='1' ? "checked='checked'" : ""}}>无　　有
                                <input type="checkbox" name="cl_intermittentpain_right" id="cl_intermittentpain_right" value="1" tabindex="12" {{substr($caselist->cl_intermittentpain.'0000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <input type="checkbox" name="cl_intermittentpain_left" id="cl_intermittentpain_left" value="1" tabindex="12" {{substr($caselist->cl_intermittentpain.'0000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <input type="checkbox" name="cl_intermittentpain_no" id="cl_intermittentpain_no" value="1" tabindex="12" {{substr($caselist->cl_intermittentpain.'0000',3,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2">血糖</th>
                        <td rowspan="2">
                            <div class="form-group has-feedback">
                                <input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="0" tabindex="6" {{$caselist->cl_blood_mne==0 ? "checked='checked'" : ""}}>早<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="1" tabindex="6" {{$caselist->cl_blood_mne==1 ? "checked='checked'" : ""}}>中<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="2" tabindex="6" {{$caselist->cl_blood_mne==2 ? "checked='checked'" : ""}}>晚&nbsp;
                                <input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="0" tabindex="6" {{$caselist->cl_blood_ap==0 ? "checked='checked'" : ""}}>前<input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="1" tabindex="6" {{$caselist->cl_blood_ap==1 ? "checked='checked'" : ""}}>后<br>
                                <input type="text" id="cl_blood_acpc" name="cl_blood_acpc" size="5" tabindex="6" title="10~999" min="10.0" max="999.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_blood_acpc }}" required> mmol/l
                                <input type="text" id="cl_blood_mins" name="cl_blood_mins" size="5" tabindex="6" value="{{ $caselist->cl_blood_mins }}" {{ $caselist->cl_blood_mins ? '' : 'disabled' }}> 分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>ABI</th>
                        <td>
                            <div class="form-group" id="clabi">
                                <input type="checkbox" name="cl_abi" id="cl_abi" value="1" tabindex="13" {{substr($caselist->cl_abi.'000',0,1)=='1' ? "checked='checked'" : ""}}>正常　异常
                                <input type="checkbox" name="cl_abi_right" id="cl_abi_right" value="1" tabindex="13" {{substr($caselist->cl_abi.'000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <input type="text" id="cl_abi_right_value" name="cl_abi_right_value" size=4 tabindex="13" value="{{ $caselist->cl_abi_right_value }}">
                                <input type="checkbox" name="cl_abi_left" id="cl_abi_left" value="1" tabindex="13" {{substr($caselist->cl_abi.'000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <input type="text" id="cl_abi_left_value" name="cl_abi_left_value" size=4 tabindex="13" value="{{ $caselist->cl_abi_left_value }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>CAVI</th>
                        <td>
                            <div class="form-group" id="clcavi">
                                <input type="checkbox" name="cl_cavi" id="cl_cavi" value="1" tabindex="14" {{substr($caselist->cl_cavi.'000',0,1)=='1' ? "checked='checked'" : ""}}>正常　异常
                                <input type="checkbox" name="cl_cavi_right" id="cl_cavi_right" value="1" tabindex="14" {{substr($caselist->cl_cavi.'000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <input type="text" id="cl_cavi_right_value" name="cl_cavi_right_value" size="4" tabindex="14" value="{{ $caselist->cl_cavi_right_value }}">
                                <input type="checkbox" name="cl_cavi_left" id="cl_cavi_left" value="1" tabindex="14" {{substr($caselist->cl_cavi.'000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <input type="text" id="cl_cavi_left_value" name="cl_cavi_left_value" size="4" tabindex="14" value="{{ $caselist->cl_cavi_left_value }}">　R-Kcavi
                                <input type="text" id="cl_cavi_rkcavi" name="cl_cavi_rkcavi" size="4" tabindex="14" value="{{ $caselist->cl_cavi_rkcavi }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>A1C</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_blood_hba1c" name="cl_blood_hba1c" size="5" tabindex="7" title="3~25" min="3.0" max="25.0" step="any"  pattern="^[0-9]{0,2}(\.[0-9]{0,1})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_blood_hba1c }}" required> %
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>视网膜检查</th>
                        <td>
                            <div class="form-group has-feedback" id="cleyechk8">
                                <input type="checkbox" name="cl_eye_chk8" id="cl_eye_chk8" value="1" tabindex="15" {{substr($caselist->cl_eye_chk8.'0000',0,1)=='1' ? "checked='checked'" : ""}}>正常　异常
                                <input type="checkbox" name="cl_eye_chk8_right" id="cl_eye_chk8_right" value="1" tabindex="15" {{substr($caselist->cl_eye_chk8.'0000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <select name="cl_eye_chk8_right_item" id="cl_eye_chk8_right_item" type="option" tabindex="15">
                                    <option value="" {!! "" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第I期</option>
                                    <option value="2" {!! "2" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第II期</option>
                                    <option value="3" {!! "3" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第III期</option>
                                    <option value="4" {!! "4" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第IV期</option>
                                    <option value="5" {!! "5" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第V期</option>
                                    <option value="6" {!! "6" == $caselist->cl_eye_chk8_right_item ? "selected='selected'" : "" !!}>第VI期</option>
                                </select>
                                <input type="checkbox" name="cl_eye_chk8_left" id="cl_eye_chk8_left" value="1" tabindex="15" {{substr($caselist->cl_eye_chk8.'0000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <select name="cl_eye_chk8_left_item" id="cl_eye_chk8_left_item" type="option" tabindex="15">
                                    <option value="" {!! "" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第I期</option>
                                    <option value="2" {!! "2" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第II期</option>
                                    <option value="3" {!! "3" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第III期</option>
                                    <option value="4" {!! "4" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第IV期</option>
                                    <option value="5" {!! "5" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第V期</option>
                                    <option value="6" {!! "6" == $caselist->cl_eye_chk8_left_item ? "selected='selected'" : "" !!}>第VI期</option>
                                </select>
                                <input type="checkbox" name="cl_eye_chk8_no" id="cl_eye_chk8_no" value="1" tabindex="15" {{substr($caselist->cl_eye_chk8.'0000',3,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>TC</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_tc" name="cl_tc" size="5" tabindex="38" title="0~6.19" min="0.00" max="6.19" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_tc }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>白內障</th>
                        <td>
                            <div class="form-group has-feedback" id="clcataract">
                                <input type="checkbox" name="cl_cataract" id="cl_cataract" value="1" tabindex="16" {{substr($caselist->cl_cataract.'0000',0,1)=='1' ? "checked='checked'" : ""}}>无　　有
                                <input type="checkbox" name="cl_cataract_right" id="cl_cataract_right" value="1" tabindex="16" {{substr($caselist->cl_cataract.'0000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <input type="checkbox" name="cl_cataract_left" id="cl_cataract_left" value="1" tabindex="16" {{substr($caselist->cl_cataract.'0000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <input type="checkbox" name="cl_cataract_no" id="cl_cataract_no" value="1" tabindex="16" {{substr($caselist->cl_cataract.'0000',3,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>TG</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_tg" name="cl_tg" size="5" tabindex="39" title="0.4~1.86" min="0.40" max="1.86" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_tg }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>心电图</th>
                        <td>
                            <div class="form-group has-feedback" id="clecg">
                                <input type="checkbox" name="cl_ecg" id="cl_ecg" value="1" tabindex="17" {{substr($caselist->cl_ecg.'00',0,1)=='1' ? "checked='checked'" : ""}}>正常　异常
                                <input type="text" id="cl_ecg_other" name="cl_ecg_other" size="20" tabindex="17" value="{{ $caselist->cl_ecg_other }}">
                                <input type="checkbox" name="cl_ecg_no" id="cl_ecg_no" value="1" tabindex="17" {{substr($caselist->cl_ecg.'00',1,1)=='1' ? "checked='checked'" : ""}}>未检查
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>LDL</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_ldl" name="cl_ldl" size="5" tabindex="40" title="2.07~3.10" min="2.07" max="3.10" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_ldl }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>冠心病</th>
                        <td>
                            <div class="form-group has-feedback" id="clcoronaryheart">
                                <input type="checkbox" name="cl_coronary_heart" id="cl_coronary_heart" value="1" tabindex="18" {{substr($caselist->cl_coronary_heart.'0',0,1)=='1' ? "checked='checked'" : ""}}>无　　异常
                                <input type="text" id="cl_coronary_heart_other" name="cl_coronary_heart_other" size="20" tabindex="18" value="{{ $caselist->cl_coronary_heart_other }}">
                                <select class="input-sm" name="cl_chh_year">
                                    <option value="-1" {!! "-1" == $caselist->cl_chh_year ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_chh_year ? "selected='selected'" : "" !!}>{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_chh_month">
                                    <option value="-1" {!! "-1" == $caselist->cl_chh_month ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_chh_month ? "selected='selected'" : "" !!}>{{ $i }}</option>
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
                                <input type="text" id="cl_hdl" name="cl_hdl" size="5" tabindex="41" title="1.2~1.68" min="1.20" max="1.68" step="any" pattern="^[0-9]{0,2}(\.[0-9]{0,2})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_hdl }}"> mmol/l
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>脑中风</th>
                        <td>
                            <div class="form-group has-feedback" id="clstroke">
                                <input type="checkbox" name="cl_stroke" id="cl_stroke" value="1" tabindex="19" {{substr($caselist->cl_stroke.'0',0,1)=='1' ? "checked='checked'" : ""}}>无　　异常
                                <select name="cl_stroke_item" id="cl_stroke_item" type="option" tabindex="19">
                                    <option value="" {!! "" == $caselist->cl_stroke_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_stroke_item ? "selected='selected'" : "" !!}>梗塞性</option>
                                    <option value="2" {!! "2" == $caselist->cl_stroke_item ? "selected='selected'" : "" !!}>出血性</option>
                                    <option value="3" {!! "3" == $caselist->cl_stroke_item ? "selected='selected'" : "" !!}>其他</option>
                                </select>
                                <input type="text" id="cl_stroke_other" name="cl_stroke_other" size="10" tabindex="19" value="{{ $caselist->cl_stroke_other }}">
                                <select class="input-sm" name="cl_sh_year">
                                    <option value="-1" {!! "-1" == $caselist->cl_sh_year ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_sh_year ? "selected='selected'" : "" !!}>{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_sh_month">
                                    <option value="-1" {!! "-1" == $caselist->cl_sh_month ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_sh_month ? "selected='selected'" : "" !!}>{{ $i }}</option>
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
                                <input type="text" id="cl_alt" name="cl_alt" size="5" tabindex="42" title="0~40" min="0" max="40" step="any" pattern="^[0-9]{1,2}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_alt }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>失明</th>
                        <td>
                            <div class="form-group has-feedback" id="clblindness">
                                <input type="checkbox" name="cl_blindness" id="cl_blindness" value="1" tabindex="20" {{substr($caselist->cl_blindness.'000',0,1)=='1' ? "checked='checked'" : ""}}>无
                                有：<input type="checkbox" name="cl_blindness_right" id="cl_blindness_right" value="1" tabindex="20" {{substr($caselist->cl_blindness.'000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <select name="cl_blindness_right_item" id="cl_blindness_right_item" type="option" tabindex="20">
                                    <option value="" {!! "" == $caselist->cl_blindness_right_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_blindness_right_item ? "selected='selected'" : "" !!}>糖尿病</option>
                                    <option value="2" {!! "2" == $caselist->cl_blindness_right_item ? "selected='selected'" : "" !!}>非糖尿病</option>
                                </select>
                                <input type="checkbox" name="cl_blindness_left" id="cl_blindness_left" value="1" tabindex="20" {{substr($caselist->cl_blindness.'000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <select name="cl_blindness_left_item" id="cl_blindness_left_item" type="option" tabindex="20">
                                    <option value="" {!! "" == $caselist->cl_blindness_left_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_blindness_left_item ? "selected='selected'" : "" !!}>糖尿病</option>
                                    <option value="2" {!! "2" == $caselist->cl_blindness_left_item ? "selected='selected'" : "" !!}>非糖尿病</option>
                                </select>
                                <select class="input-sm" name="cl_bh_year">
                                    <option value="-1" {!! "-1" == $caselist->cl_bh_year ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_bh_year ? "selected='selected'" : "" !!}>{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_bh_month">
                                    <option value="-1" {!! "-1" == $caselist->cl_bh_month ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_bh_month ? "selected='selected'" : "" !!}>{{ $i }}</option>
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
                                <input type="text" id="cl_ggt" name="cl_ggt" size="5" tabindex="43" title="11~61" min="11" max="61" step="any" pattern="^[0-9]{1,2}$" maxlength="2" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_ggt }}"> U/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>透析</th>
                        <td>
                            <div class="form-group has-feedback" id="cldialysis">
                                <input type="checkbox" name="cl_dialysis" id="cl_dialysis" value="1" tabindex="21" {{substr($caselist->cl_dialysis.'0',0,1)=='1' ? "checked='checked'" : ""}}>无
                                有：<select name="cl_dialysis_item" id="cl_dialysis_item" type="option" tabindex="21">
                                    <option value="" {!! "" == $caselist->cl_dialysis_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_dialysis_item ? "selected='selected'" : "" !!}>血液透析</option>
                                    <option value="2" {!! "2" == $caselist->cl_dialysis_item ? "selected='selected'" : "" !!}>腹膜透析</option>
                                </select>
                                <select class="input-sm" name="cl_dh_year">
                                    <option value="-1" {!! "-1" == $caselist->cl_dh_year ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_dh_year ? "selected='selected'" : "" !!}>{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_dh_month">
                                    <option value="-1" {!! "-1" == $caselist->cl_dh_month ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_dh_month ? "selected='selected'" : "" !!}>{{ $i }}</option>
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
                                <input type="text" id="cl_uricacid" name="cl_uricacid" size="5" tabindex="44" title="40~97" min="40.0" max="97.0" step="any" pattern="^[0-9]{1,2}(\.[0-9]{0,1})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_uricacid }}" onblur="calceGFR(this.value, {{ $sex }}, {{ $caselist->cl_patientid }})"> μmol/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>下肢截肢</th>
                        <td>
                            <div class="form-group has-feedback" id="clamputation">
                                <input type="checkbox" name="cl_amputation" id="cl_amputation" value="1" tabindex="22" {{substr($caselist->cl_amputation.'000',0,1)=='1' ? "checked='checked'" : ""}}>无
                                有：<input type="checkbox" name="cl_amputation_right" id="cl_amputation_right" value="1" tabindex="22" {{substr($caselist->cl_amputation.'000',1,1)=='1' ? "checked='checked'" : ""}}>右
                                <select name="cl_amputation_right_item" id="cl_amputation_right_item" type="option" tabindex="22">
                                    <option value="" {!! "" == $caselist->cl_amputation_right_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_amputation_right_item ? "selected='selected'" : "" !!}>糖尿病</option>
                                    <option value="2" {!! "2" == $caselist->cl_amputation_right_item ? "selected='selected'" : "" !!}>非糖尿病</option>
                                </select>
                                <input type="checkbox" name="cl_amputation_left" id="cl_amputation_left" value="1" tabindex="22" {{substr($caselist->cl_amputation.'000',2,1)=='1' ? "checked='checked'" : ""}}>左
                                <select name="cl_amputation_left_item" id="cl_amputation_left_item" type="option" tabindex="22">
                                    <option value="" {!! "" == $caselist->cl_amputation_left_item ? "selected='selected'" : "" !!}>请选择</option>
                                    <option value="1" {!! "1" == $caselist->cl_amputation_left_item ? "selected='selected'" : "" !!}>糖尿病</option>
                                    <option value="2" {!! "2" == $caselist->cl_amputation_left_item ? "selected='selected'" : "" !!}>非糖尿病</option>
                                </select>
                                <input type="text" id="cl_amputation_other" name="cl_amputation_other" size="10" tabindex="22" value="{{ $caselist->cl_amputation_other }}">
                                <select class="input-sm" name="cl_ah_year">
                                    <option value="-1" {!! "-1" == $caselist->cl_ah_year ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = $year; $i > 1910; $i--)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_ah_year ? "selected='selected'" : "" !!}>{{ $i }}</option>
                                    @endfor
                                </select>年
                                <select class="input-sm" name="cl_ah_month">
                                    <option value="-1" {!! "-1" == $caselist->cl_ah_month ? "selected='selected'" : "" !!}>不详</option>
                                    @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}" {!! "$i" == $caselist->cl_ah_month ? "selected='selected'" : "" !!}>{{ $i }}</option>
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
                                <input type="text" id="cl_ua" name="cl_ua" size="5" tabindex="45" title="155~428" min="155.0" max="428.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_ua }}"> μmol/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>高低血糖就医</th>
                        <td>
                            <div class="form-group has-feedback" id="clmedicaltreatment">
                                <input type="checkbox" name="cl_medical_treatment" id="cl_medical_treatment" value="1" tabindex="23" {{substr($caselist->cl_medical_treatment.'0',0,1)=='1' ? "checked='checked'" : ""}}>无
                                有：<input type="text" id="cl_medical_treatment_other" name="cl_medical_treatment_other" size="10" tabindex="23" value="{{ $caselist->cl_medical_treatment_other }}"> 次/月
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="1" tabindex="23" {{$caselist->cl_medical_treatment_emergency==1 ? "checked='checked'" : ""}}>急诊
                                <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="2" tabindex="23" {{$caselist->cl_medical_treatment_emergency==2 ? "checked='checked'" : ""}}>住院
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>尿微</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="cl_urine_micro" name="cl_urine_micro" size="5" tabindex="46" title="0~30" min="0.0" max="30.0" step="any" pattern="^[0-9]{1,2}(\.[0-9]{0,1})?$" maxlength="4" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_urine_micro }}"> mg/L
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                        <th>饮酒</th>
                        <td>
                            <div class="form-group has-feedback" id="cldrinking">
                                <input type="checkbox" name="cl_drinking" id="cl_drinking" value="1" tabindex="24" {{substr($caselist->cl_drinking.'0',0,1)=='1' ? "checked='checked'" : ""}}>无
                                有：<input type="text" id="cl_drinking_other" name="cl_drinking_other" size="10" tabindex="24" value="{{ $caselist->cl_drinking_other }}"> c.c/周
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>尿蛋白</th>
                        <td>
                            <select name="cl_urine_routine" id="cl_urine_routine" type="option" tabindex="47">
                                <option value="" {!! "" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>请选择</option>
                                <option value="1" {!! "1" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>正常</option>
                                <option value="2" {!! "2" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>+</option>
                                <option value="3" {!! "3" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>++</option>
                                <option value="4" {!! "4" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>+++</option>
                                <option value="5" {!! "5" == $caselist->cl_urine_routine ? "selected='selected'" : "" !!}>++++</option>
                            </select>
                        </td>
                        <th>抽烟</th>
                        <td>
                            <div class="form-group has-feedback" id="clsmoking">
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="0" tabindex="25" {{$caselist->cl_smoking==0 ? "checked='checked'" : ""}}>无
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="1" tabindex="25" {{$caselist->cl_smoking==1 ? "checked='checked'" : ""}}>有
                                <input type="text" name="cl_havesmoke" id="cl_havesmoke" size="3" tabindex="25" value="{{ $caselist->cl_havesmoke }}">支
                                <input type="radio" name="cl_smoking" id="cl_smoking" value="2" tabindex="25" {{$caselist->cl_smoking==2 ? "checked='checked'" : ""}}>已戒
                                <input type="text" name="cl_quitsmoke" id="cl_quitsmoke" size="10" tabindex="25" value="{{ $caselist->cl_quitsmoke }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>eGFR</th>
                        <td>
                            <div class="form-group">
                                <input type="text" id="cl_egfr" name="cl_egfr" style="background-color:#CCCCCC" size="5" tabindex="48" title="1~500" pattern="^[0-9]{1,3}(\.[0-9]{0,2})?$" min="1.00" max="500.00" step="any" maxlength="6" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_egfr }}" readonly> ml/min/1.73m<sup>2</sup>
                            </div>
                        </td>
                        <th>牙周病变</th>
                        <td>
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="0" tabindex="26" {{$caselist->cl_periodontal==0 ? "checked='checked'" : ""}}>无
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="1" tabindex="26" {{$caselist->cl_periodontal==1 ? "checked='checked'" : ""}}>有
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="2" tabindex="26" {{$caselist->cl_periodontal==2 ? "checked='checked'" : ""}}>不详
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>咀嚼功能</th>
                        <td>
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="0" tabindex="27" {{$caselist->cl_masticatory==0 ? "checked='checked'" : ""}}>正常
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="1" tabindex="27" {{$caselist->cl_masticatory==1 ? "checked='checked'" : ""}}>异常
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>彩超</th>
                        <td>
                            <div class="form-group has-feedback" id="clultrasound">
                                <input type="checkbox" name="cl_ultrasound0" id="cl_ultrasound0" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',0,1)=='1' ? "checked='checked'" : ""}}>无<br>有，如下：<br>
                                <input type="checkbox" name="cl_ultrasound1" id="cl_ultrasound1" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',1,1)=='1' ? "checked='checked'" : ""}}>双下肢
                                <input type="text" id="cl_ultrasound01" name="cl_ultrasound01" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound01 }}"><br>
                                <input type="checkbox" name="cl_ultrasound2" id="cl_ultrasound2" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',2,1)=='1' ? "checked='checked'" : ""}}>心脏
                                <input type="text" id="cl_ultrasound02" name="cl_ultrasound02" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound02 }}"><br>
                                <input type="checkbox" name="cl_ultrasound3" id="cl_ultrasound3" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',3,1)=='1' ? "checked='checked'" : ""}}>颈部
                                <input type="text" id="cl_ultrasound03" name="cl_ultrasound03" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound03 }}"><br>
                                <input type="checkbox" name="cl_ultrasound4" id="cl_ultrasound4" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',4,1)=='1' ? "checked='checked'" : ""}}>消化
                                <input type="text" id="cl_ultrasound04" name="cl_ultrasound04" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound04 }}"><br>
                                <input type="checkbox" name="cl_ultrasound5" id="cl_ultrasound5" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',5,1)=='1' ? "checked='checked'" : ""}}>泌尿
                                <input type="text" id="cl_ultrasound05" name="cl_ultrasound05" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound05 }}"><br>
                                <input type="checkbox" name="cl_ultrasound6" id="cl_ultrasound6" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',6,1)=='1' ? "checked='checked'" : ""}}>甲状腺
                                <input type="text" id="cl_ultrasound06" name="cl_ultrasound06" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound06 }}"><br>
                                <input type="checkbox" name="cl_ultrasound7" id="cl_ultrasound7" value="1" tabindex="28" {{substr($caselist->cl_ultrasound.'00000000',7,1)=='1' ? "checked='checked'" : ""}}>妇科
                                <input type="text" id="cl_ultrasound07" name="cl_ultrasound07" size="20" tabindex="28" value="{{ $caselist->cl_ultrasound07 }}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered bg-success" id="casegeneral1408"  {!! $caselist->cl_case_type==4 ? '' : 'style="display: none"' !!}>
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
                                <input type="text" id="_cl_base_sbp" name="_cl_base_sbp" size="5" tabindex="1" title="30~300" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_base_sbp }}"> /&nbsp;
                                <input type="text" id="_cl_base_ebp" name="_cl_base_ebp" size="5" tabindex="1" title="20~130" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_base_ebp }}"> mmHg
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>脉搏</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_pulse" name="_cl_pulse" size="5" tabindex="2" title="30~150" pattern="^[0-9]{1,}$" maxlength="3" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_pulse }}"> 次/分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>身高</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_tall" name="_cl_base_tall" size="5" onblur="_calcIBW(this.value)" tabindex="3" title="50~200" min="50.0" max="200.0" step="any" value="{{ $caselist->cl_base_tall }}"> cm
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>体重</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="text" id="_cl_base_weight" name="_cl_base_weight" size="5" onblur="_calcBMI(this.value)" tabindex="4" title="3~160" min="3.0" max="160.0" step="any" value="{{ $caselist->cl_base_weight }}"> kg　
                                <input type="checkbox" name="_cl_noweight" id="_cl_noweight" value="1" onclick="_clkweight(this.id)" {{substr($caselist->cl_noweight.'0',0,1)=='1' ? "checked='checked'" : ""}}>无法测量　　
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>IBW / BMI</th>
                        <td>
                            <input type="text" id="_cl_ibw" name="_cl_ibw" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ $caselist->cl_ibw }}" readonly> kg/
                            <input type="text" id="_cl_bmi" name="_cl_bmi" size="5" style="background-color:#CCCCCC" tabindex="-1" value="{{ $caselist->cl_bmi }}" readonly> kg/m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <th>血糖</th>
                        <td>
                            <div class="form-group has-feedback">
                                <input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="0" tabindex="5" {{$caselist->cl_blood_mne==0 ? "checked='checked'" : ""}}>早<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="1" tabindex="5" {{$caselist->cl_blood_mne==1 ? "checked='checked'" : ""}}>中<input type="radio" name="_cl_blood_mne" id="_cl_blood_mne" value="2" tabindex="5" {{$caselist->cl_blood_mne==2 ? "checked='checked'" : ""}}>晚&nbsp;
                                <input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="0" tabindex="5" {{$caselist->cl_blood_ap==0 ? "checked='checked'" : ""}}>前<input type="radio" name="_cl_blood_ap" id="_cl_blood_ap" value="1" tabindex="5" {{$caselist->cl_blood_ap==1 ? "checked='checked'" : ""}}>后
                                <input type="text" id="_cl_blood_acpc" name="_cl_blood_acpc" size="5" tabindex="5" title="10~999" min="10.0" max="999.0" step="any" pattern="^[0-9]{1,3}(\.[0-9]{0,1})?$" maxlength="5" data-minlength="1" data-minlength-error="输入数字长度不足" value="{{ $caselist->cl_blood_acpc }}"> mmol/l
                                <input type="text" id="_cl_blood_mins" name="_cl_blood_mins" size="5" tabindex="5" value="{{ $caselist->cl_blood_mins }}" {{ $caselist->cl_blood_mins ? '' : 'disabled' }}> 分
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>抽烟</th>
                        <td>
                            <div class="form-group has-feedback" id="_clsmoking">
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="0" tabindex="6" {{$caselist->cl_smoking==0 ? "checked='checked'" : ""}}>无　　
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="1" tabindex="6" {{$caselist->cl_smoking==1 ? "checked='checked'" : ""}}>有
                                <input type="text" name="_cl_havesmoke" id="_cl_havesmoke" size="3" tabindex="6" value="{{ $caselist->cl_havesmoke }}">支
                                <input type="radio" name="_cl_smoking" id="_cl_smoking" value="2" tabindex="6" {{$caselist->cl_smoking==2 ? "checked='checked'" : ""}}>已戒
                                <input type="text" name="_cl_quitsmoke" id="_cl_quitsmoke" size="10" tabindex="6" value="{{ $caselist->cl_quitsmoke }}">
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
        </div>
    </div>
@endsection

@section('loadScripts')
    {!! Html::script('js/case.js') !!}
@stop
