$(function() {
/* 因媛媛未確認, 先取消必填檢查!!
    $('#caseform').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            var bool = true;
            if($("#cl_case_type option:selected").val() != 4) {
                var msg = "请注意:\n";
                var m1 = " 需填写!\n";
                var m2 = " 需勾选!\n";
                if (!$("#clfootchkright input[type='checkbox']").is(":checked")) {
                    msg += "足部检查(右)" + m2;
                    bool = false;
                }
                if (!$("#clfootchkleft input[type='checkbox']").is(":checked")) {
                    msg += "足部检查(左)" + m2;
                    bool = false;
                }
                if (!$("#clulcers input[type='checkbox']").is(":checked")) {
                    msg += "溃疡/坏疽" + m2;
                    bool = false;
                }
                if (!$("#clcomplications input[type='checkbox']").is(":checked") && !$("#clcomplications input[type='radio']").is(":checked")) {
                    msg += "并发症" + m2;
                    bool = false;
                }
                if (!$("#clintermittentpain input[type='checkbox']").is(":checked")) {
                    msg += "下肢间歇痛" + m2;
                    bool = false;
                }
                if (!$("#cleyechk8 input[type='checkbox']").is(":checked")) {
                    msg += "视网膜检查" + m2;
                    bool = false;
                }
                if (!$("#clcataract input[type='checkbox']").is(":checked")) {
                    msg += "白內障" + m2;
                    bool = false;
                }
                if (!$("#clecg input[type='checkbox']").is(":checked") && $('#cl_ecg_other').val() == '') {
                    msg += "心电图" + m2;
                    bool = false;
                }
                if (!$("#clcoronaryheart input[type='checkbox']").is(":checked") && $('#cl_coronary_heart_other').val() == '') {
                    msg += "冠心病" + m2;
                    bool = false;
                }
                if (!$("#clstroke input[type='checkbox']").is(":checked") && !$("#cl_stroke_item option:selected")) {
                    msg += "脑中风" + m2;
                    bool = false;
                }
                if (!$("#clblindness input[type='checkbox']").is(":checked")) {
                    msg += "失明" + m2;
                    bool = false;
                }
                if (!$("#cldialysis input[type='checkbox']").is(":checked") && !$("#cl_dialysis_item option:selected")) {
                    msg += "洗肾" + m2;
                    bool = false;
                }
                if (!$("#clamputation input[type='checkbox']").is(":checked")) {
                    msg += "下肢截肢" + m2;
                    bool = false;
                }
                if (!$("#clmedicaltreatment input[type='checkbox']").is(":checked") && !$("#clmedicaltreatment input[type='radio']").is(":checked")) {
                    msg += "高低血糖就医" + m2;
                    bool = false;
                }
                if (!$("#cldrinking input[type='checkbox']").is(":checked") && $('#cl_drinking_other').val() == '') {
                    msg += "饮酒" + m2;
                    bool = false;
                }
                if (!$("#clsmoking input[type='radio']").is(":checked") && $('#cl_havesmoke').val() == '' && $('#cl_quitsmoke').val() == '') {
                    msg += "抽烟" + m2;
                    bool = false;
                }
                if (bool === false) alert(msg);
            }
            return bool;
        }
    });
*/

    $("#cl_case_date").datepicker( {
    });

    $("#cl_foot_chk_right0").click(function() {
        if($(this).is(":checked")) {
            $("#clfootchkright input[type='checkbox']").attr("disabled", true);
            $("#clfootchkright input[type='checkbox']").attr("checked", false);
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clfootchkright input[type='checkbox']").attr("disabled", false);
        }
    });
    $("#cl_foot_chk_left0").click(function() {
        if($(this).is(":checked")) {
            $("#clfootchkleft input[type='checkbox']").attr("disabled", true);
            $("#clfootchkleft input[type='checkbox']").attr("checked", false);
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clfootchkleft input[type='checkbox']").attr("disabled", false);
        }
    });
    $("#cl_ulcers").click(function() {
        if($(this).is(":checked")) {
            $("#clulcers input[type='checkbox']").attr("disabled", true);
            $("#clulcers input[type='checkbox']").attr("checked", false);
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clulcers input[type='checkbox']").attr("disabled", false);
        }
    });
    $("#cl_complications0").click(function() {
        if($(this).is(":checked")) {
            $("#clcomplications input[type='checkbox']").attr("disabled", true);
            $("#clcomplications input[type='checkbox']").attr("checked", false);
            $("#clcomplications input[type='radio']").attr("disabled", true);
            $("#clcomplications input[type='radio']").attr("checked", false);
            $("#clcomplications input[type='text']").attr("disabled", true);
            $("#clcomplications input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clcomplications input[type='checkbox']").attr("disabled", false);
            $("#clcomplications input[type='radio']").attr("disabled", false);
            $("#clcomplications input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_intermittentpain").click(function() {
        if($(this).is(":checked")) {
            $("#clintermittentpain input[type='checkbox']").attr("disabled", true);
            $("#clintermittentpain input[type='checkbox']").attr("checked", false);
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clintermittentpain input[type='checkbox']").attr("disabled", false);
        }
    });
    $("input:radio[name=cl_blood_ap]").on("change", function() {
        if($(this).val() === "1") {
            $("#cl_blood_mins").attr("disabled", false);
        } else {
            $("#cl_blood_mins").attr("disabled", true);
            $("#cl_blood_mins").val("");
        }
    });
    $("#cl_abi").click(function() {
        if($(this).is(":checked")) {
            $("#clabi input[type='checkbox']").attr("disabled", true);
            $("#clabi input[type='checkbox']").attr("checked", false);
            $("#clabi input[type='text']").attr("disabled", true);
            $("#clabi input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clabi input[type='checkbox']").attr("disabled", false);
            $("#clabi input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_cavi").click(function() {
        if($(this).is(":checked")) {
            $("#clcavi input[type='checkbox']").attr("disabled", true);
            $("#clcavi input[type='checkbox']").attr("checked", false);
            $("#clcavi input[type='text']").attr("disabled", true);
            $("#clcavi input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clcavi input[type='checkbox']").attr("disabled", false);
            $("#clcavi input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_eye_chk8").click(function() {
        if($(this).is(":checked")) {
            $("#cleyechk8 input[type='checkbox']").attr("disabled", true);
            $("#cleyechk8 input[type='checkbox']").attr("checked", false);
            $("select[name='cl_eye_chk8_right_item']").prop("disabled", true);
            $("select[name='cl_eye_chk8_right_item']").val('');
            $("select[name='cl_eye_chk8_left_item']").prop("disabled", true);
            $("select[name='cl_eye_chk8_left_item']").val('');
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#cleyechk8 input[type='checkbox']").attr("disabled", false);
            $("select[name='cl_eye_chk8_right_item']").prop("disabled", false);
            $("select[name='cl_eye_chk8_left_item']").prop("disabled", false);
        }
    });
    $("#cl_cataract").click(function() {
        if($(this).is(":checked")) {
            $("#clcataract input[type='checkbox']").attr("disabled", true);
            $("#clcataract input[type='checkbox']").attr("checked", false);
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clcataract input[type='checkbox']").attr("disabled", false);
        }
    });
    $("#cl_ecg").click(function() {
        if($(this).is(":checked")) {
            $("#clecg input[type='checkbox']").attr("disabled", true);
            $("#clecg input[type='checkbox']").attr("checked", false);
            $("#clecg input[type='text']").attr("disabled", true);
            $("#clecg input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clecg input[type='checkbox']").attr("disabled", false);
            $("#clecg input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_coronary_heart").click(function() {
        if($(this).is(":checked")) {
            $("#clcoronaryheart input[type='checkbox']").attr("disabled", true);
            $("#clcoronaryheart input[type='checkbox']").attr("checked", false);
            $("#clcoronaryheart input[type='text']").attr("disabled", true);
            $("#clcoronaryheart input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clcoronaryheart input[type='checkbox']").attr("disabled", false);
            $("#clcoronaryheart input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_stroke").click(function() {
        if($(this).is(":checked")) {
            $("#clstroke input[type='checkbox']").attr("disabled", true);
            $("#clstroke input[type='checkbox']").attr("checked", false);
            $("select[name='cl_stroke_item']").prop("disabled", true);
            $("select[name='cl_stroke_item']").val('');
            $("#clstroke input[type='text']").attr("disabled", true);
            $("#clstroke input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clstroke input[type='checkbox']").attr("disabled", false);
            $("select[name='cl_stroke_item']").prop("disabled", false);
            $("#clstroke input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_blindness").click(function() {
        if($(this).is(":checked")) {
            $("#clblindness input[type='checkbox']").attr("disabled", true);
            $("#clblindness input[type='checkbox']").attr("checked", false);
            $("select[name='cl_blindness_right_item']").prop("disabled", true);
            $("select[name='cl_blindness_left_item']").prop("disabled", true);
            $("select[name='cl_blindness_right_item']").val('');
            $("select[name='cl_blindness_left_item']").val('');
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clblindness input[type='checkbox']").attr("disabled", false);
            $("select[name='cl_blindness_right_item']").prop("disabled", false);
            $("select[name='cl_blindness_left_item']").prop("disabled", false);
        }
    });
    $("#cl_dialysis").click(function() {
        if($(this).is(":checked")) {
            $("#cldialysis input[type='checkbox']").attr("disabled", true);
            $("#cldialysis input[type='checkbox']").attr("checked", false);
            $("select[name='cl_dialysis_item']").prop("disabled", true);
            $("select[name='cl_dialysis_item']").val('');
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#cldialysis input[type='checkbox']").attr("disabled", false);
            $("select[name='cl_dialysis_item']").prop("disabled", false);
        }
    });
    $("#cl_amputation").click(function() {
        if($(this).is(":checked")) {
            $("#clamputation input[type='checkbox']").attr("disabled", true);
            $("#clamputation input[type='checkbox']").attr("checked", false);
            $("select[name='cl_amputation_right_item']").prop("disabled", true);
            $("select[name='cl_amputation_left_item']").prop("disabled", true);
            $("select[name='cl_amputation_right_item']").val('');
            $("select[name='cl_amputation_left_item']").val('');
            $("#clamputation input[type='text']").attr("disabled", true);
            $("#clamputation input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clamputation input[type='checkbox']").attr("disabled", false);
            $("select[name='cl_amputation_right_item']").prop("disabled", false);
            $("select[name='cl_amputation_left_item']").prop("disabled", false);
            $("#clamputation input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_medical_treatment").click(function() {
        if($(this).is(":checked")) {
            $("#clmedicaltreatment input[type='checkbox']").attr("disabled", true);
            $("#clmedicaltreatment input[type='checkbox']").attr("checked", false);
            $("#clmedicaltreatment input[type='radio']").attr("disabled", true);
            $("#clmedicaltreatment input[type='radio']").attr("checked", false);
            $("#clmedicaltreatment input[type='text']").attr("disabled", true);
            $("#clmedicaltreatment input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clmedicaltreatment input[type='checkbox']").attr("disabled", false);
            $("#clmedicaltreatment input[type='radio']").attr("disabled", false);
            $("#clmedicaltreatment input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_drinking").click(function() {
        if($(this).is(":checked")) {
            $("#cldrinking input[type='checkbox']").attr("disabled", true);
            $("#cldrinking input[type='checkbox']").attr("checked", false);
            $("#cldrinking input[type='text']").attr("disabled", true);
            $("#cldrinking input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#cldrinking input[type='checkbox']").attr("disabled", false);
            $("#cldrinking input[type='text']").attr("disabled", false);
        }
    });
    $("input:radio[name=cl_smoking]").on("change", function() {
        if($(this).val() === "0") {
            $("#clsmoking input[type='text']").attr("disabled", true);
            $("#clsmoking input[type='text']").val("");
        } else {
            $("#clsmoking input[type='text']").attr("disabled", false);
        }
    });
    $("input:radio[name=_cl_blood_ap]").on("change", function() {
        if($(this).val() === "1") {
            $("#_cl_blood_mins").attr("disabled", false);
        } else {
            $("#_cl_blood_mins").attr("disabled", true);
            $("#_cl_blood_mins").val("");
        }
    });
    $("input:radio[name=_cl_smoking]").on("change", function() {
        if($(this).val() === "0") {
            $("#_clsmoking input[type='text']").attr("disabled", true);
            $("#_clsmoking input[type='text']").val("");
        } else {
            $("#_clsmoking input[type='text']").attr("disabled", false);
        }
    });
    $("#cl_ultrasound0").click(function() {
        if($(this).is(":checked")) {
            $("#clultrasound input[type='checkbox']").attr("disabled", true);
            $("#clultrasound input[type='checkbox']").attr("checked", false);
            $("#clultrasound input[type='text']").attr("disabled", true);
            $("#clultrasound input[type='text']").val("");
            $(this).prop("disabled", false);
            $(this).prop("checked", true);
        } else {
            $("#clultrasound input[type='checkbox']").attr("disabled", false);
            $("#clultrasound input[type='text']").attr("disabled", false);
        }
    });

    // 計算IBW
    $("#cl_base_tall").blur();
    $("#_cl_base_tall").blur();

});

function updateTxtContent(val){
    if (val == '') {
        $("#caseis1409").hide();
        $("#casegeneral1408").hide();
    } else {
        if (val == 4) {
            $("#caseis1409").hide();
            $("#casegeneral1408").show();
            $('#casegeneral1408').addClass('bg-success');
        } else {
            $("#caseis1409").show();
            $("#casegeneral1408").hide();
            $('#caseis1409').removeClass('bg-warning');
            $('#caseis1409').removeClass('bg-info');
            $('#caseis1409').removeClass('bg-danger');
            if (val == 1) $('#caseis1409').addClass('bg-warning');
            if (val == 2) $('#caseis1409').addClass('bg-info');
            if (val == 3) $('#caseis1409').addClass('bg-danger');
        }
    }
}

function calcIBW(val){
    var _ibw = document.getElementById("cl_ibw");
    if( !isNaN(val) && (val !== 0) ){
        val = val / 100;
        _ibw.value = (val * val * 22).toFixed(1);
    } else {
        _ibw.value = '';
    }
}

function _calcIBW(val){
    var _ibw = document.getElementById("_cl_ibw");
    if( !isNaN(val) && (val !== 0) ){
        val = val / 100;
        _ibw.value = (val * val * 22).toFixed(1);
    } else {
        _ibw.value = '';
    }
}

function calcBMI(val){
    var _bmi = document.getElementById("cl_bmi");
    var _tall = document.getElementById("cl_base_tall").value;
    if( !isNaN(val) && (val !== 0) && (_tall !== 0) ){
        _tall = _tall / 100;
        _bmi.value = (val / (_tall * _tall)).toFixed(1);
    } else {
        _bmi.value = '';
    }
}

function _calcBMI(val){
    var _bmi = document.getElementById("_cl_bmi");
    var _tall = document.getElementById("_cl_base_tall").value;
    if( !isNaN(val) && (val !== 0) && (_tall !== 0) ){
        _tall = _tall / 100;
        _bmi.value = (val / (_tall * _tall)).toFixed(1);
    } else {
        _bmi.value = '';
    }
}

function calceGFR(val, sex, pid){
    var _ua = parseFloat(val);
    var _d1 = document.getElementById("cl_case_date");
    var _pid = pid.toString();
    var age = _pid.substr(6, 4) + "-" + _pid.substr(10, 2) + "-" + _pid.substr(12, 2);
    var D2 = new Date(age);
    var D1 = new Date(_d1.value);
    var Compare = Date.parse(D1.toString()) - Date.parse(D2.toString()); //相差毫秒數
    var ComDay = Compare / (1000 * 60 * 24 * 60); //相差天數
    var _female = 0;
    var _age = 0;
    if(sex == 0){
        _female = 0.742;
    } else {
        _female = 1;
    }
    var _egfr = document.getElementById("cl_egfr");
    if( !isNaN(_ua) && (_ua !== 0) ){
        _ua = _ua / 88.4;
        _ua = Math.pow(_ua, -1.154);
        _age = ComDay / 365;
        _age = Math.pow(_age, -0.203);
        _egfr.value = (186 * _ua * _age * _female).toFixed(2);
    } else {
        _egfr.value = '';
    }
}

function clkweight(id){
    var _bool = document.getElementById(id).checked;
    var _id = document.getElementById("cl_base_weight");
    if(_bool){
        _id.value = '';
        _id.disabled = true;
        var _bmi = document.getElementById("cl_bmi");
        if(_bmi.value !== ''){
            _bmi.value = '';
        }
    } else {
        _id.disabled = false;
    }
}

function _clkweight(id){
    var _bool = document.getElementById(id).checked;
    var _id = document.getElementById("_cl_base_weight");
    if(_bool){
        _id.value = '';
        _id.disabled = true;
        var _bmi = document.getElementById("_cl_bmi");
        if(_bmi.value !== ''){
            _bmi.value = '';
        }
    } else {
        _id.disabled = false;
    }
}

function printdiv(){
    var divstr = document.getElementById("printpage").innerHTML;
    var header = '<header><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>';
    var footer = "";
    var popupWin = window.open('', '_blank', 'left=1,top=1,width=1100,height=600,resizable=1,location=0,personalbar=0,scrollbars=1,statusbar=0,toolbar=0,menubar=0');
    popupWin.document.open();
    popupWin.document.write('<html><head><title>打印</title><style type="text/css">@media print{@page {size:landscape;}} table{width:1000px;font-size:11px;word-spacing:1px;line-height:10pt;padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;}</style></head><body onload="window.print()"><p style="font-size: xx-small;">' + divstr + '</p></body></html>' + footer);
    popupWin.document.close();
    return false;
}