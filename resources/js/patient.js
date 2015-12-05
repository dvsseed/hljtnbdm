$(function() {
    $("#pp_birthday").datepicker( {
        onClose: function(){
            $(this).trigger("change");
        }
    });
    $("#pp_birthday").bind("change", function() {
        var thisyear = (new Date).getFullYear();
        var lastyear = $("#pp_birthday").val().substr(0, 4);
        appendyear("cc_mdate", thisyear, lastyear);
    });

    $("#pp_patientid").blur(function() {
        var pid = $("#pp_patientid").val();
        $("#pp_personid").val(pid);
        $("#account").val(pid);
        $("#pp_birthday").val(pid.substr(6, 4) + '-' + pid.substr(10, 2) + '-' + pid.substr(12, 2));
        var thisyear = (new Date).getFullYear();
        $("#pp_age").val(thisyear - pid.substr(6, 4));
        var lastyear = $("#pp_birthday").val().substr(0, 4);
        appendyear("cc_mdate", thisyear, lastyear);
    });
    var appendyear = function(obj, thisyear, lastyear) {
        $("#" + obj).empty().append("<option value='-1'>¤£?</option>");
        for (var i = thisyear; i >= lastyear; i--){
            $("#" + obj).append("<option value='" + i + "'>" + i + "</option>");
        }
    }

    $("#pp_weight").blur(function() {
        var hh = $("#pp_height").val() / 100;
        var ww = $("#pp_weight").val();
        if(hh > 0 && ww > 0) {
            $("#cc_ibw").val(Math.round(hh * hh * 22 * 10) / 10);
            $("#cc_bmi").val(Math.round(ww / (hh * hh) * 10) / 10);
        }
    });

    $("input:radio[name=cc_status]").on("change", function() {
        if($(this).val() === "1") {
            $("#ccstatus input[type='checkbox']").attr("disabled", false);
            $("#ccstatus input[type='text']").attr("disabled", false);
        } else {
            $("#ccstatus input[type='checkbox']").attr("disabled", true);
            $("#ccstatus input[type='checkbox']").attr("checked", false);
            $("#ccstatus input[type='text']").attr("disabled", true);
            $("#ccstatus input[type='text']").val("");
        }
    });

    $("input:radio[name=cc_current_use]").on("change", function() {
        if($(this).val() === "1") {
            $("#cccurrent input[type='checkbox']").attr("disabled", false);
            $("select[name='cc_starty']").prop("disabled", false);
            $("select[name='cc_startm']").prop("disabled", false);
        } else {
            $("#cccurrent input[type='checkbox']").attr("disabled", true);
            $("select[name='cc_starty']").prop("disabled", true);
            $("select[name='cc_startm']").prop("disabled", true);
            $("#cccurrent input[type='checkbox']").attr("checked", false);
            $("select[name='cc_starty']").val(-1);
            $("select[name='cc_startm']").val(-1);
        }
    });

    $("input:radio[name=cc_hinder]").on("change", function() {
        if($(this).val() === "1") {
            $("#cchinder input[type='checkbox']").attr("disabled", false);
            $("#cchinder input[type='text']").attr("disabled", false);
        } else {
            $("#cchinder input[type='checkbox']").attr("disabled", true);
            $("#cchinder input[type='checkbox']").attr("checked", false);
            $("#cchinder input[type='text']").attr("disabled", true);
            $("#cchinder input[type='text']").val("");
        }
    });

    $("#pp_email").completer({
        separator: "@",
        source: ["126.com", "163.com", "yeah.net", "qq.com", "gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "live.com", "aol.com", "mail.com"]
    });

});