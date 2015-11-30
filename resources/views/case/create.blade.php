@extends('master')

@section('title')
    方案资料-增
@stop

@section('css')
    {{-- !! Html::style('css/case.css') !! --}}
@stop

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>方案资料 / 增</h3>
        </div>

        <div class="col-md-12">
            @include('errors.list')
            <div class="form-group">
                <label class="control-label" for="scase">方案</label>
                <select name="scase" id="scase" class="form-control" onchange="updateTxtContent(this.value,0);">
                    @foreach($casetypes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <form action="{{ route('case.store') }}" method="POST" role="form" data-toggle="validator">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%">评估项目</th>
                        <th class="text-center" width="30%">结 果</th>
                        <th class="text-center" width="10%">评估项目</th>
                        <th class="text-center">结 果</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="text-danger">*</span>血压</td>
                        <td>
                            <input type="text" name="cl_base_sbp" size="5" onkeyup="num_valid(this)" tabindex="1" title="30~300" /> /
                            <input type="text" name="cl_base_ebp" size="5" onkeyup="num_valid(this)" tabindex="1" title="20~130" /> mmhg
                        </td>
                        <td><span class="text-danger">*</span>足部检查 (右)</td>
                        <td>
                            <input type="checkbox" name="cl_foot_chk_right0" value="1" tabindex="9" onclick="checkid(this.id, 16)" />正常
                            <input type="checkbox" name="cl_foot_chk_right1" value="1" tabindex="9">震动
                            <input type="checkbox" name="cl_foot_chk_right2" value="1" tabindex="9">针刺
                            <input type="checkbox" name="cl_foot_chk_right3" value="1" tabindex="9">脉搏
                            <input type="checkbox" name="cl_foot_chk_right4" value="1" tabindex="9">绕道
                            <input type="checkbox" name="cl_foot_chk_right5" value="1" tabindex="9">未检查
                        </td>
                    </tr>
                    <tr>
                        <td><span class="text-danger">*</span>脉搏</td>
                        <td>
                            <input type="text" id="cl_Pulse" name="cl_pulse" size="5" onkeyup="num_valid(this)" tabindex="2" title="30~150"> 次/分
                        </td>
                        <td><span class="text-danger">*</span>足部检查 (左)</td>
                        <td>
                            <input type="checkbox" name="cl_foot_chk_left0" value="1" tabindex="10" onclick="checkid(this.id, 17)">正常
                            <input type="checkbox" name="cl_foot_chk_left1" value="1" tabindex="10">震动
                            <input type="checkbox" name="cl_foot_chk_left2" value="1" tabindex="10">针刺
                            <input type="checkbox" name="cl_foot_chk_left3" value="1" tabindex="10">脉搏
                            <input type="checkbox" name="cl_foot_chk_left4" value="1" tabindex="10">绕道
                            <input type="checkbox" name="cl_foot_chk_left5" value="1" tabindex="10">未检查
                        </td>
                    </tr>
                    <tr>
                        <td><span class="text-danger">*</span>身高</td>
                        <td>
                            <input type="text" id="cl_base_tall" name="cl_base_tall" size=5 maxlength=6 onkeyup="num_valid(this)" onblur="calcIBW(\'"cl_\',this.value)" tabindex="3" title="50~200" /> cm
                        </td>
                        <td><span class="text-danger">*</span>溃疡 / 坏疽</td>
                        <td>
                            <input type="checkbox" name="cl_ulcers" id="cl_ulcers" value="1" onclick="checkid(this.id, 1)" tabindex="11" />无
                            急性期(<input type="checkbox" name="cl_ulcers_urgent_right" id="cl_ulcers_urgent_right" value="1" tabindex="11">右/<input type="checkbox" name="cl_ulcers_urgent_left" id="cl_ulcers_urgent_left" value="1" tabindex="11">左)&nbsp;
                            慢性期(<input type="checkbox" name="cl_ulcers_slow_right" id="cl_ulcers_slow_righ" value="1" tabindex="11">右/<input type="checkbox" name="cl_ulcers_slow_left" id="cl_ulcers_slow_left" value="1" tabindex="11">左)
                        </td>
                    </tr>
                    <tr>
                        <td><span class="text-danger">*</span>体重</td>
                        <td>
                            <input type="text" id="cl_base_weight" name="cl_base_weight" size=5 maxlength=6 onkeyup="num_valid(this)" onblur="calcBMI(\'"cl_\',this.value)" tabindex="4" title="3~160" /> kg
                            <input type="checkbox" name="cl_noweight" id="cl_noweight" value="1" onclick="clkweight(this.id)" ' . (($_c === 'd8_') ? 'disabled' : (($_c === 'd9_') ? 'disabled' : (($_c === 'd1_') ? 'disabled' : (($_c === 'd2_') ? 'disabled' : '')))) . '/>无法测量
                        </td>
                        <td rowspan=2><span class="text-danger">*</span>并发症</td>
                        <td rowspan=2>
                            <input type="checkbox" name="cl_complications0" id="cl_complications0" value="1" onclick="checkid(this.id, 2)" tabindex="12" ' . showCheck($CLComplications, 0) . ' />无　　肾病变: stage
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="1" tabindex="12" ' . showRadio($CL_Complications_stage, 1) . '>1
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="2" tabindex="12" ' . showRadio($CL_Complications_stage, 2) . '>2
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="3" tabindex="12" ' . showRadio($CL_Complications_stage, 3) . '>3a
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="4" tabindex="12" ' . showRadio($CL_Complications_stage, 4) . '>3b
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="5" tabindex="12" ' . showRadio($CL_Complications_stage, 5) . '>4
                            <input type="radio" name="cl_complications_stage" id="cl_complications_stage" value="6" tabindex="12" ' . showRadio($CL_Complications_stage, 6) . '>5<br />
                    　　　　<input type="checkbox" name="cl_complications1" id="cl_complications1" value="1" tabindex="12" ' . showCheck($CLComplications, 1) . '>神经病变
                            <input type="checkbox" name="cl_complications2" id="cl_complications2" value="1" tabindex="12" ' . showCheck($CLComplications, 2) . '>周边血管病变
                            其他<input type="text" id="cl_complications_other" name="cl_complications_other" size=10 tabindex="12" ' . showText($CL_Complications_Other) . '>
                        </td>
                    </tr>
                    <tr>
                        <td>IBW / BMI</td>
                        <td>
                            <input type="text" id="cl_ibw" name="cl_ibw" size=5 onkeyup="num_valid(this)" style="background-color:#CCCCCC" tabindex="-1" readonly /> kg/
                            <input type="text" id="cl_bmi" name="cl_bmi" size=5 onkeyup="num_valid(this)" style="background-color:#CCCCCC" tabindex="-1" readonly /> kg/m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <td>腰 / 臀围</td>
                        <td>
                            <input type="text" id="cl_waist" name="cl_waist" size=5 onkeyup="num_valid(this)" tabindex="6" title="20~200" /> cm/
                            <input type="text" id="cl_hips" name="cl_hips" size=5 onkeyup="num_valid(this)" tabindex="6" title="20~200" /> cm
                        </td>
                        <td><span class="text-danger">*</span>下肢间歇痛</td>
                        <td>
                            <input type="checkbox" name="cl_intermittentpain" id="cl_intermittentpain" value="1" onclick="checkid(this.id, 3)" tabindex="13" />无　　有
                            <input type="checkbox" name="cl_intermittentpain_right" id="cl_intermittentpain_right" value="1" tabindex="13">右
                            <input type="checkbox" name="cl_intermittentpain_left" id="cl_intermittentpain_left" value="1" tabindex="13">左
                            <input type="checkbox" name="cl_intermittentpain_no" id="cl_intermittentpain_no" value="1" tabindex="13">未检查
                        </td>
                    </tr>
                    <tr>
                        <td rowspan=2><span class="text-danger">*</span>血糖</td>
                        <td rowspan=2>
                            <input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="0" tabindex="7" checked>早<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="1" tabindex="7">中<input type="radio" name="cl_blood_mne" id="cl_blood_mne" value="2" tabindex="7">晚&nbsp;
                            <input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="0" tabindex="7" ' . (($_c === 'c7_') ? '' : (($_c === 'c9_') ? '' : (($_c === 'd9_') ? '' : ' onclick="checkid(this.id, 18)" '))) . ' checked>前<input type="radio" name="cl_blood_ap" id="cl_blood_ap" value="1" tabindex="7" ' . (($_c === 'c7_') ? 'disabled="disabled"' : (($_c === 'c9_') ? 'disabled="disabled"' : (($_c === 'd9_') ? 'disabled="disabled"' : ' onclick="checkid(this.id, 18)" '))) . '>后<br />
                            <input type="text" id="cl_blood_acpc" name="cl_blood_acpc" size=5 maxlength=8 onkeyup="num_valid(this)" tabindex="7" title="10~999" /> mg/dL
                            <input type="text" id="cl_blood_mins" name="cl_blood_mins" size=5 maxlength=8 onkeyup="num_valid(this)" tabindex="7" disabled /> 分
                        </td>
                        <td>ABI</td>
                        <td>
                            <input type="checkbox" name="cl_abi" id="cl_abi" value="1" onclick="checkid(this.id, 4)" tabindex="14" />正常　异常
                            <input type="checkbox" name="cl_abi_right" id="cl_abi_right" value="1" tabindex="14">右
                            <input type="text" id="cl_abi_right_value" name="cl_abi_right_value" size=4 onkeyup="num_valid(this)" tabindex="14">
                            <input type="checkbox" name="cl_abi_left" id="cl_abi_left" value="1" tabindex="14">左
                            <input type="text" id="cl_abi_left_value" name="cl_abi_left_value" size=4 onkeyup="num_valid(this)" tabindex="14">
                        </td>
                    </tr>
                    <tr>
                        <td>CAVI</td>
                        <td>
                            <input type="checkbox" name="cl_cavi" id="cl_cavi" value="1" onclick="checkid(this.id, 5)" tabindex="15" />正常　异常
                            <input type="checkbox" name="cl_cavi_right" id="cl_cavi_right" value="1" tabindex="15">右
                            <input type="text" id="cl_cavi_right_value" name="cl_cavi_right_value" size=4 onkeyup="num_valid(this)" tabindex="15">
                            <input type="checkbox" name="cl_cavi_left" id="cl_cavi_left" value="1" tabindex="15">左
                            <input type="text" id="cl_cavi_left_value" name="cl_cavi_left_value" size=4 onkeyup="num_valid(this)" tabindex="15">　R-Kcavi
                            <input type="text" id="cl_cavi_rkcavi" name="cl_cavi_rkcavi" size=4 onkeyup="num_valid(this)" tabindex="15">
                        </td>
                    </tr>
                    <tr>
                        <td><span class="text-danger">*</span>A1C</td>
                        <td>
                            <input type="text" id="cl_blood_hba1c" name="cl_blood_hba1c" size=5 maxlength=6 onkeyup="num_valid(this)" tabindex="8" title="3~25" ' . showText($CL_BLOOD_HBA1C) . ' /> %
                        </td>
                        <td><span class="text-danger">*</span>视网膜检查</td>
                        <td>
                            <input type="checkbox" name="cl_eye_chk8" id="cl_eye_chk8" value="1" onclick="checkid(this.id, 6)" tabindex="16" />正常　异常
                            <input type="checkbox" name="cl_eye_chk8_right" id="cl_eye_chk8_right" value="1" tabindex="16">右
                            <select name="cl_eye_chk8_right_item" id="cl_eye_chk8_right_item" style="font-size:12pt" type="option" tabindex="16">
                                <option value="0">请选择</option>
                                <option value="1">NPDR</option>
                                <option value="2">PDR</option>
                                <option value="3">NPDR/PRP</option>
                                <option value="4">PDR/PRP</option>
                            </select>
                            <input type="checkbox" name="cl_eye_chk8_left" id="cl_eye_chk8_left" value="1" tabindex="16">左
                            <select name="cl_eye_chk8_left_item" id="cl_eye_chk8_left_item" style="font-size:12pt" type="option" tabindex="16">
                                <option value="0">请选择</option>
                                <option value="1">NPDR</option>
                                <option value="2">PDR</option>
                                <option value="3">NPDR/PRP</option>
                                <option value="4">PDR/PRP</option>
                            </select>
                            <input type="checkbox" name="cl_eye_chk8_no" id="cl_eye_chk8_no" value="1" tabindex="16">未检查
                        </td>
                    </tr>
                    <tr>
                        <td>Cholesterol</td>
                        <td>
                            <input type="text" id="cl_cholesterol name="cl_cholesterol size=5 onkeyup="num_valid(this)" tabindex="28" title="50~300" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>白內障</td>
                        <td>
                            <input type="checkbox" name="cl_cataract" id="cl_cataract" value="1" onclick="checkid(this.id, 7)" tabindex="17" ' . showCheck($CLCataract, 0) . ' />无　　有
                            <input type="checkbox" name="cl_cataract_right" id="cl_cataract_right" value="1" tabindex="17" ' . showCheck($CLCataract, 1) . '>右
                            <input type="checkbox" name="cl_cataract_left" id="cl_cataract_left" value="1" tabindex="17" ' . showCheck($CLCataract, 2) . '>左
                            <input type="checkbox" name="cl_cataract_no" id="cl_cataract_no" value="1" onclick="checkid(this.id, 19)" tabindex="17" ' . showCheck($CLCataract, 3) . '>未检查
                        </td>
                    </tr>
                    <tr>
                        <td>Triglyceride</td>
                        <td>
                            <input type="text" id="cl_triglyceride" name="cl_triglyceride" size=5 onkeyup="num_valid(this)" tabindex="29" title="20~3000" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>心电图</td>
                        <td>
                            <input type="checkbox" name="cl_ecg" id="cl_ecg" value="1" onclick="checkid(this.id, 8)" tabindex="18" />正常　异常
                            <select name="cl_ecg_item" id="cl_ecg_item" style="font-size:12pt" type="option" tabindex="18">
                                <option value="0">请选择</option>
                                <option value="1">PVC</option>
                                <option value="2">Af</option>
                                <option value="3">NS-ST change</option>
                                <option value="4">其他</option>
                            </select>
                            <input type="text" id="cl_ecg_other" name="cl_ecg_other" size=10 tabindex="18">
                            <input type="checkbox" name="cl_ecg_no" id="cl_ecg_no" value="1" tabindex="18">未检查
                        </td>
                    </tr>
                    <tr>
                        <td>LDL</td>
                        <td>
                            <input type="text" id="cl_blood_tg" name="cl_blood_tg" size=5 maxlength=8 onkeyup="num_valid(this)" tabindex="30" title="50~300" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>冠心病</td>
                        <td>
                            <input type="checkbox" name="cl_coronary_heart" id="cl_coronary_heart" value="1" onclick="checkid(this.id, 9)" tabindex="19" ' . showCheck($CL_CoronaryHeart, 0) . ' />无　　异常
                            <select name="cl_coronary_heart_item" id="cl_coronary_heart_item" style="font-size:12pt" type="option" tabindex="19>
                                <option value="0" ' . showSelect($CL_Coronary_Heart_Item, 0) . '>请选择</option>
                                <option value="1" ' . showSelect($CL_Coronary_Heart_Item, 1) . '>冠状动脉绕道术</option>
                                <option value="2" ' . showSelect($CL_Coronary_Heart_Item, 2) . '>支架</option>
                                <option value="3" ' . showSelect($CL_Coronary_Heart_Item, 3) . '>气球扩张术</option>
                                <option value="4" ' . showSelect($CL_Coronary_Heart_Item, 4) . '>其他</option>
                            </select>
                            <input type="text" id="cl_coronary_heart_other" name="cl_coronary_heart_other" size=10 tabindex="19">
                        </td>
                    </tr>
                    <tr>
                        <td>HDL</td>
                        <td>
                            <input type="text" id="cl_hdl" name="cl_hdl" size=5 onkeyup="num_valid(this)" tabindex="31" title="10~200" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>脑中风</td>
                        <td>
                            <input type="checkbox" name="cl_stroke" id="cl_stroke" value="1" onclick="checkid(this.id, 10)" tabindex="20" ' . showCheck($CLStroke, 0) . ' />无　　异常
                            <select name="cl_stroke_item" id="cl_stroke_item" style="font-size:12pt" type="option" tabindex="20">
                                <option value="0" ' . showSelect($CL_Stroke_Item, 0) . '>请选择</option>
                                <option value="1" ' . showSelect($CL_Stroke_Item, 1) . '>梗塞性</option>
                                <option value="2" ' . showSelect($CL_Stroke_Item, 2) . '>出血性</option>
                                <option value="3" ' . showSelect($CL_Stroke_Item, 3) . '>其他</option>
                            </select>
                            <input type="text" id="cl_stroke_other" name="cl_stroke_other" size=10 tabindex="20">
                        </td>
                    </tr>
                    <tr>
                        <td>GPT</td>
                        <td>
                            <input type="text" id="cl_gpt" name="cl_gpt" size=5 onkeyup="num_valid(this)" tabindex="32" title="5~2000" /> U/L
                        </td>
                        <td><span class="text-danger">*</span>失明</td>
                        <td>
                            <input type="checkbox" name="cl_blindness" id="cl_blindness" value="1" onclick="checkid(this.id, 11)" tabindex="21" ' . showCheck($CLBlindness, 0) . ' />无
                            有：<input type="checkbox" name="cl_blindness_right" id="cl_blindness_right" value="1" tabindex="21" ' . showCheck($CLBlindness, 1) . '>右
                            <select name="cl_blindness_right_item" id="cl_blindness_right_item" style="font-size:12pt" type="option" tabindex="21">
                                <option value="0" ' . showSelect($CL_Blindness_RIGHT_Item, 0) . '>请选择</option>
                                <option value="1" ' . showSelect($CL_Blindness_RIGHT_Item, 1) . '>糖尿病</option>
                                <option value="2" ' . showSelect($CL_Blindness_RIGHT_Item, 0) . '>非糖尿病</option>
                            </select>
                            <input type="checkbox" name="cl_blindness_left" id="cl_blindness_left" value="1" tabindex="21" ' . showCheck($CLBlindness, 2) . '>左
                            <select name="cl_blindness_left_item" id="cl_blindness_left_item" style="font-size:12pt" type="option" tabindex="21">
                                <option value="0" ' . showSelect($CL_Blindness_LEFT_Item, 0) . '>请选择</option>
                                <option value="1" ' . showSelect($CL_Blindness_LEFT_Item, 1) . '>糖尿病</option>
                                <option value="2" ' . showSelect($CL_Blindness_LEFT_Item, 2) . '>非糖尿病</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Creatinine</td>
                        <td>
                            <input type="text" id="cl_blood_creat" name="cl_blood_creat" size=5 maxlength=8 onkeyup="num_valid(this)" tabindex="33" title="0.1~20" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>洗肾</td>
                        <td>
                            <input type="checkbox" name="cl_dialysis" id="cl_dialysis" value="1" onclick="checkid(this.id, 12)" tabindex="22" ' . showCheck($CLDialysis, 0) . ' />无
                            有：<select name="cl_dialysis_item" id="cl_dialysis_item" style="font-size:12pt" type="option" tabindex="22">
                                <option value="0" ' . showSelect($CL_Dialysis_Item, 0) . '>请选择</option>
                                <option value="1" ' . showSelect($CL_Dialysis_Item, 1) . '>血液透析</option>
                                <option value="2" ' . showSelect($CL_Dialysis_Item, 2) . '>腹膜透析</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Uric Acid</td>
                        <td>
                            <input type="text" id="cl_uricacid" name="cl_uricacid" size=5 onkeyup="num_valid(this)" tabindex="34" title="4~25" /> mg/dL
                        </td>
                        <td><span class="text-danger">*</span>下肢截肢</td>
                        <td>
                            <input type="checkbox" name="cl_amputation" id="cl_amputation" value="1" onclick="checkid(this.id, 13)" tabindex="23" />无
                            有：<input type="checkbox" name="cl_amputation_right" id="cl_amputation_right" value="1" tabindex="23">右
                            <select name="cl_amputation_right_item" id="cl_amputation_right_item" style="font-size:12pt" type="option" tabindex="23">
                                <option value="0">请选择</option>
                                <option value="1">糖尿病</option>
                                <option value="2">非糖尿病</option>
                            </select>
                            <input type="checkbox" name="cl_amputation_left" id="cl_amputation_left" value="1" tabindex="23">左
                            <select name="cl_amputation_left_item" id="cl_amputation_left_item" style="font-size:12pt" type="option" tabindex="23">
                                <option value="0">请选择</option>
                                <option value="1">糖尿病</option>
                                <option value="2">非糖尿病</option>
                            </select>
                            <input type="text" id="cl_amputation_other" name="cl_amputation_other" size=10 tabindex="23">
                        </td>
                    </tr>
                    <tr>
                        <td>A/C ratio</td>
                        <td>
                            <input type="text" id="cl_urine_micro" name="cl_urine_micro" size=5 maxlength=8 onkeyup="num_valid(this)" tabindex="35" title="0.1~2500" /> mg/g
                        </td>
                        <td><span class="text-danger">*</span>高低血糖就医</td>
                        <td>
                            <input type="checkbox" name="cl_medical_treatment" id="cl_medical_treatment" value="1" onclick="checkid(this.id, 14)" tabindex="24" />无
                            有：<input type="text" id="cl_medical_treatment_other" name="cl_medical_treatment_other" size=10 tabindex="24"> 次/月
                            <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="1" tabindex="24">急诊
                            <input type="radio" name="cl_medical_treatment_emergency" id="cl_medical_treatment_emergency" value="2" tabindex="24">住院
                        </td>
                    </tr>
                    <tr>
                        <td>U<sub>PCR</sub></td>
                        <td>
                            <input type="text" id="cl_upcr" name="cl_upcr" size=5 onkeyup="num_valid(this)" tabindex="36" title="0.1~5000" /> mg/g
                        </td>
                        <td><span class="text-danger">*</span>饮酒</td>
                        <td>
                            <input type="checkbox" name="cl_drinking" id="cl_drinking" value="1" onclick="checkid(this.id, 15)" tabindex="25" />无
                            有：<input type="text" id="cl_drinking_other" name="cl_drinking_other" size=10 tabindex="25"> c.c/周
                        </td>
                    </tr>
                    <tr>
                        <td>Urine protein</td>
                        <td>
                            <input type="radio" name="cl_urine_routine" id="cl_urine_routine" value="1" tabindex="37">正常
                            异常<input type="radio" name="cl_urine_routine" id="cl_urine_routine" value="2" tabindex="37">+<input type="radio" name="cl_urine_routine" id="cl_urine_routine" value="3" tabindex="37">2+<input type="radio" name="cl_urine_routine" id="cl_urine_routine" value="4" tabindex="37">3+<input type="radio" name="cl_urine_routine" id="cl_urine_routine" value="5" tabindex="37">4+
                        </td>
                        <td><span class="text-danger">*</span>抽烟</td>
                        <td>
                            <input type="radio" name="cl_smoking" id="cl_smoking" value="0" tabindex="26" ' . showRadio($CL_Smoking, 0) . '>无
                            <input type="radio" name="cl_smoking" id="cl_smoking" value="1" tabindex="26" ' . showRadio($CL_Smoking, 1) . '>有
                            <input type="text" name="cl_havesmoke" id="cl_havesmoke" size=3 tabindex="26" ' . showText($CL_haveSmoke) . '>支
                            <input type="radio" name="cl_smoking" id="cl_smoking" value="2" tabindex="26" ' . showRadio($CL_Smoking, 2) . '>已戒
                            <input type="text" name="cl_quitsmoke" id="cl_quitsmoke" size=10 tabindex="26" ' . showText($CL_quitSmoke) . '>
                        </td>
                    </tr>
                    <tr>
                        <td>eGFR</td>
                        <td>
                            <input type="text" id="cl_egfr" name="cl_egfr" size=5 maxlength=5 onkeyup="num_valid(this)" tabindex="38" title="1~500" /> ml/min/1.73m<sup>2</sup>
                        </td>
                        <td>牙周病变</td>
                        <td>
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="0" tabindex="27">无
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="1" tabindex="27">有
                            <input type="radio" name="cl_periodontal" id="cl_periodontal" value="2" tabindex="27">不详
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>咀嚼功能</td>
                        <td>
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="0" tabindex="28">正常
                            <input type="radio" name="cl_masticatory" id="cl_masticatory" value="1" tabindex="28">异常

                            <input type="hidden" id="cl_case_date" name="cl_case_date" value="' . $ctsDate . '" /><!-- hidden: 收案日期 -->
                            <input type="hidden" id="cl_case_educator" name="cl_case_educator" value="' . $EDUCATOR . '" /><!-- hidden: 衛教師姓名 -->
                            <input type="hidden" id="cl_case_educator_id" name="cl_case_educator_id"value="' . $CASE_EDUCATOR_ID . '" /><!-- hidden: 衛教師ID -->
                            <input type="hidden" id="cl_case_type" name="cl_case_type" /><!-- hidden: 方案類型=診療階段 -->
                            <input type="hidden" id="cl_pp_name" name="cl_pp_name" value="' . $PPName . '"><!-- hidden: 病患姓名 -->
                            <input type="hidden" id="cl_pp_patientid" name="cl_pp_patientid" value="' . $PPPatientID . '"><!-- hidden: 病患ID -->
                            <input type="hidden" name="cl_savecase" value="">
                            <input type="hidden" name="cl_action" value="add">
                            <input type="hidden" name="cl_soautoid" value="' . $row['0'] . '"><!-- SOAP.SO_AutoID -->
                            <input type="hidden" name="cl_ttautoid" value="' . $Tid . '"><!-- TEMPLIST.TT_AutoID -->
                            <input type="hidden" name="cl_pid" value="' . $rowP['1'] . '"><!-- PatientProfile1.PP_PatientID -->
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- a class="btn btn-default" href="{{-- route('case.index') --}}">返回</a -->
                <a class="btn btn-default" href="{{ route('case.index') }}">历史纪录</a>
                <button class="btn btn-primary" type="submit">保存</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/case.js') !!}
@stop
