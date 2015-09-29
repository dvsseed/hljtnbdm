/**
 * Created by purplebleed on 2015/9/22.
 */

    var mapping = {
        'early_morning': '凌晨',
        'morning': '晨起',
        'breakfast_before': '早餐飯前',
        'breakfast_after': '早餐飯後',
        'lunch_before': '中餐飯前',
        'lunch_after': '中餐飯後',
        'dinner_brfore': '晚餐飯前',
        'dinner_after': '晚餐飯後',
        'sleep_before': '睡前'
    };
    var mapping_time = {
        'early_morning': '00:01',
        'morning': '06:01',
        'breakfast_before': '07:01',
        'breakfast_after': '09:01',
        'lunch_before': '11:01',
        'lunch_after': '13:01',
        'dinner_brfore': '17:01',
        'dinner_after': '19:01',
        'sleep_before': '20:01'
    };

$( document ).ready(function() {
    $(".menuLink").on('click', function (e) {
        $(this).parent().parent().find('.active').removeClass('active');
        $('.nav').find('.active').removeClass('active');
        $(this).parent().addClass('active');
        e.preventDefault();
        $('.content').hide();
        $($(this).attr('href')).show();
    });

    $('#timepicker').timepicker({
        defaultTime: '00:01',
        minutes: {
            starts: 0,
            ends: 59,
            interval: 1,
            manual: []
        }
    });

});

function updateBloodSugar(calendar_date, type, sugar_value) {

    sugar_value = typeof sugar_value !== 'undefined' ? sugar_value : null;

    $("#calendar_date").html(calendar_date);
    $("#range").html(mapping[type]);
    $('#timepicker').timepicker('setTime', mapping_time[type]);

    if (sugar_value != null) {
        $.ajax({
            method: "GET",
            url: "detail/" + calendar_date + "/" + type
        }).done(function (result) {

            $("#filter").show();
            $("#insert_data").show();
            console.log(result);
            if (result) {
                if (result["measure_time"])
                    $('#timepicker').timepicker('setTime', result["measure_time"].split(" ")[1]);
                else
                    $('#timepicker').timepicker('setTime', mapping_time[type]);
                $("#blood_sugar").val(sugar_value);
                if (result['exercise_type'] != null) {
                    $('#sport').val(result['exercise_type']);
                    $('#duration').val(result['exercise_duration']);
                }
                if (result['low_blood_sugar']) {
                    $('#low').val(result['low_blood_sugar']);
                }
                if (result['insulin_type_1']) {
                    $('#insulin_type_1').val(result['insulin_type_1']);
                    $('#insulin_value_1').val(result['insulin_value_1']);
                }
                if (result['insulin_type_2']) {
                    $('#insulin_type_2').val(result['insulin_type_2']);
                    $('#insulin_value_2').val(result['insulin_value_2']);
                }
                if (result['insulin_type_3']) {
                    $('#insulin_type_3').val(result['insulin_type_3']);
                    $('#insulin_value_3').val(result['insulin_value_3']);
                }
                if (result['sugar']) {
                    $('#sugar').val(result['sugar']);
                }
                if (result['note']) {
                    $('#note').val(result['note']);
                }
            }

        });
    }
    else{
        $("#filter").show();
        $("#insert_data").show();
    }

    $("#save").click(function(){

        var flag = true;

        $("#blood_sugar_err").html("");
        $("#insulin_1_err").html("");
        $("#insulin_2_err").html("");
        $("#insulin_3_err").html("");
        $("#sugar_err").html("");

        if($('#blood_sugar').val()  == ""){
            $("#blood_sugar_err").html("不能是空白");
            flag = false;
        }
        else if (isNaN($('#blood_sugar').val() / 1)) {
            $("#blood_sugar_err").html("必須是數字");
            flag = false;
        }
        if ($('#insulin_type_1').val() != 0 &&  isNaN($('#insulin_value_1').val() / 1)) {
            $("#insulin_1_err").html("必須是數字");
            flag = false;
        }
        if ($('#insulin_type_2').val() != 0 && isNaN($('#insulin_value_2').val() / 1)) {
            $("#insulin_2_err").html("必須是數字");
            flag = false;
        }
        if ($('#insulin_type_3').val() != 0 && isNaN($('#insulin_value_3').val() / 1)) {
            $("#insulin_3_err").html("必須是數字");
            flag = false;
        }
        if (isNaN($('#sugar').val() / 1) ) {
            $("#sugar_err").html("必須是數字");
            flag = false;
        }
        if($("#sport").val() != "none" && $("#duration").val() == "none"){
            $("#sport_err").html("必須填入時間");
            flag = false;
        }

        if(flag){
            var insert_data={};
            insert_data['calendar_date'] = calendar_date;
            insert_data['measure_time'] = calendar_date+" "+$('#timepicker').timepicker('getTime');
            insert_data['measure_type'] = type;
            insert_data['blood_sugar'] = $("#blood_sugar").val();
            insert_data['low_blood_sugar'] = $("#low").val();
            if($("#sport").val() != "none"){
                insert_data['exercise_type'] = $("#sport").val();
                insert_data['exercise_duration'] = $("#duration").val();
            }
            if($('#insulin_type_1').val() != 0){
                insert_data['insulin_type_1'] = $("#insulin_type_1").val();
                insert_data['insulin_value_1'] = $("#insulin_value_1").val();
            }
            if($('#insulin_type_2').val() != 0){
                insert_data['insulin_type_2'] = $("#insulin_type_2").val();
                insert_data['insulin_value_2'] = $("#insulin_value_2").val();
            }
            if($('#insulin_type_3').val() != 0){
                insert_data['insulin_type_3'] = $("#insulin_type_3").val();
                insert_data['insulin_value_3'] = $("#insulin_value_3").val();
            }
            if($('#sugar').val() != ""){
                insert_data['sugar'] = $("#sugar").val();
            }
            if($('#note').val() != ""){
                insert_data['note'] = $("#note").val();
            }
            insert_data['_token'] = $('input[name=_token]').val();
            $.ajax({
                type: 'POST',
                url: 'upsert',
                data: insert_data,
                success: function(result){
                    if(result == "success"){
                        $("#filter").hide();
                        $("#insert_data").hide();
                        location.reload();
                    }else{
                        alert(儲存失敗);
                    }
                },
                error: function(){
                    alert(儲存失敗);
                }
            });
        }
    });

    $("#cancel").click(function(event){
        event.preventDefault();

        $("#sport").val("none");
        $("#duration").val("none");
        $("#low").val("0");
        $("#insulin_type_1").val("0");
        $("#insulin_type_2").val("0");
        $("#insulin_type_3").val("0");
        $("#insulin_value_1").val("");
        $("#insulin_value_2").val("");
        $("#insulin_value_3").val("");
        $("#sugar").val("");
        $("#note").val("");

        $("#filter").hide();
        $("#insert_data").hide();

    });

}

function insertFood(calendar_date, type) {
    
}