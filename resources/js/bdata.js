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
    'dinner_before': '晚餐飯前',
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
    'dinner_before': '17:01',
    'dinner_after': '19:01',
    'sleep_before': '20:01'
};
var patt = /\d{4}-\d{2}-\d{2}/;
$( document ).ready(function() {

    $(".menuLink").on('click', function (e) {
        $(this).parent().parent().find('.active').removeClass('active');
        $('.nav').find('.active').removeClass('active');
        $(this).parent().addClass('active');
        $('.content').hide();

        if(!$(this).hasClass("real")){
            e.preventDefault();
        }

        var link = $(this).attr('href');
        if( link == '#batchInsert'){
            link = '#data';
        }

        $(link).show({
            duration: 1,
            always: checkContent
        });
        if($(this).attr('href') == "#message"){
            setUpMessage();
        }else if($(this).attr('href') == "#statics"){
            getStaticsData();
        }
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

    $('#food_timepicker').timepicker({
        defaultTime: '00:01',
        minutes: {
            starts: 0,
            ends: 59,
            interval: 1,
            manual: []
        }
    });

    var mode = getUrlParameter("mode");
    if(mode){
        if($("[href =" +  "#" + mode +"]").length > 0){
            $("[href =" +  "#" + mode +"]").click();
        }
        else{
            $('[href ' + '= #data]').click();
        }
    }
    else{
        $('[href =' + ' #data]').click();
    }
});

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function checkContent(){
    if($(this).attr('id') == 'data'){
        var active = $("#top").find('.active').children('a').attr('href');

        var trs = $("#sugartable > tbody").children("tr");
        for(var i = 2; i < trs.length; i++){
            var tr = $(trs[i]);
            tr.children('td').each (function() {
                if(active == '#data'){
                    $(this).children('#normal').show();
                    $(this).children('#sugar_batch').hide();
                }else if(active == '#batchInsert'){
                    $(this).children('#normal').hide();
                    $(this).children('#sugar_batch').show();
                }
            });

            if(active == '#batchInsert'){
                tr.find('#sugar_batch_empty').show();
                tr.find('#sugar_batch_empty').click(function(){
                    var tr = $(this).parents('tr');
                    tr.children('td').each (function() {
                        $(this).children('#sugar_batch').val("");
                    });
                });
            }
        }
        if(active == '#data'){
            $('.statics_data').show();
            $('.batch_save_tr').hide();
        }else if(active == '#batchInsert'){
            $('.statics_data').hide();
            $('.batch_save_tr').show();
        }

        if(active == '#batchInsert'){

            $('#batch_save_btn').click(function(event){
                $(this).prop('disabled', true);
                var flag = true;
                var batch_data = [];
                var trs = $("#sugartable > tbody").children("tr");
                for(var i = 2; i < trs.length; i++){
                    var single_record = {};
                    var tr = $(trs[i]);
                    tr.children('td').each (function() {
                        if($(this).children('#sugar_batch')){
                            var sugar_value = $(this).children('#sugar_batch').val();
                            if(isNaN(sugar_value)){
                                flag = false;
                                $(this).children('#sugar_batch').addClass('error');
                            }else if(sugar_value != ''){

                                single_record[$(this).children('#sugar_batch').attr('data')] = sugar_value;
                            }
                        }
                    });

                    if(patt.test(tr.children('td:first').html())){
                        single_record['calendar_date'] = tr.children('td:first').html();
                    }

                    if(!$.isEmptyObject(single_record)){
                        batch_data.push(single_record);
                    }
                }
                console.log(batch_data);
                event.preventDefault();
                $(this).blur();
                var inputdata = {};
                inputdata['sugar_data'] = batch_data;
                inputdata['_token'] = $('#batch_form > input[ name=_token]').val();
                $.ajax({
                    type: 'POST',
                    url: '/bdata/batch_update',
                    data: inputdata,
                    success: function(result){
                        if(result == 'success'){
                            location.reload();
                        }
                    }
                });
            });

            var href = $("#before_two_week").attr('href');
            if(href)
                $("#before_two_week").attr('href', href + "?mode=batchInsert");
            href = $("#after_two_week").attr('href');
            if(href)
                $("#after_two_week").attr('href', href + "?mode=batchInsert");
        }
        else if(active == '#data'){
            var href = $("#before_two_week").attr('href');
            href = href.split('?')[0]
            if(href)
                $("#before_two_week").attr('href', href);
            href = $("#after_two_week").attr('href');
            if(href)
                $("#after_two_week").attr('href', href);
        }
    }
}

function setUpBatch(){
    $("#batch").click(function(event){
        event.preventDefault();
        $(this).parent().parent().find('.active').removeClass('active');
        $('.nav').find('.active').removeClass('active');
        $(this).parent().addClass('active');
        $('#data').show();

        var trs = $("#sugartable > tbody").children("tr");
        for(var i = 2; i < trs.length; i++){
            var tr = $(trs[i]);
            tr.children('td').each (function() {
                $(this).children('#normal').hide();
                $(this).children('#sugar_batch').show();
            });
            tr.find('#sugar_batch_empty').show();
            tr.find('#sugar_batch_empty').click(function(){
                var tr = $(this).parents('tr');
                tr.children('td').each (function() {
                    $(this).children('#sugar_batch').val("");
                });
            });
        }

        $('.statics_data').hide();
        $('.batch_save_tr').show();
    });
}

function setUpMessage(){
    //setting for message
    $("#messages").css('height', $( window ).height() - $("#top").offset().top - $("#top").height() - 150 );
    $("#reply").click(function(event){
        var inputdata = {};
        inputdata['message_body'] = $("#messagearea").val();
        inputdata['_token'] = $('#message_form > input[ name=_token]').val();
        event.preventDefault();

        if(inputdata['message_body'] == '' ){
            $("#messagearea").addClass('error');
        }else{
            $.ajax({
                type: 'POST',
                url: '/bdata/post_message',
                data: inputdata,
                success: function(result){
                    if(result == 'success'){
                        getMessageData();
                        $("#reply").blur();
                        $("#messagearea").val('');
                    }
                }
            });
        }
    });

    $('#messages').scroll(function() {
        if($('#messages').scrollTop() + $('#messages').height() == $("#message_table").height()) {
            $.ajax({
                type: 'GET',
                url: '/bdata/message?start=' + $('#message_count').val(),
                success: function(result){
                    var trs = $(result).find("tr");
                    for(var i = 0; i < trs.length; i++){
                        var tr = $(trs[i]);
                        tr.insertAfter('#message_table tr:last');
                    }
                    $('#message_count').val(parseInt($('#message_count').val()) + trs.length);
                }
            });
        }
    });

    getMessageData();
}

function getStaticsData(){
    $.ajax({
        type: 'GET',
        url: '/bdata/food/statics',
        success: function(result){
            $("#statics").html(result);
        }
    });
}

function getMessageData(){
    $.ajax({
        type: 'GET',
        url: '/bdata/message',
        success: function(result){
            $("#messages").html(result);
        }
    });
}

function clear(amount,unit){
    amount.val("");
    unit.val("gram");
    calc_sugar();
}

function foodHandler(event){
    var food_type =event.data.type;
    var default_value =event.data.value;
    var food_category =event.data.category;
    if(food_category.val() != 0){

        $.ajax({
            type: 'GET',
            url: '/bdata/foods/'+food_category.val(),
            success: function(result){
                var html ="";

                if(result.length > 0){
                    for(i = 0; i < result.length; i++){
                        if(default_value == result[i].food_pk)
                            html += "<option selected value='" + result[i].food_pk + "' gram='" + result[i].gram_sugar_value + "' set='" + result[i].set_sugar_value + "'>"+result[i].food_name + "</option>";
                        else
                            html += "<option value='" + result[i].food_pk + "' gram='" + result[i].gram_sugar_value + "' set='" + result[i].set_sugar_value + "'>" + result[i].food_name + " </option>";
                    }
                }
                else{
                    html = "<option value=\"0\">無</option>";
                }

                food_type.html(html);

                set_sugar_option_value();
                calc_sugar();
            }
        });
    }
    else{
        food_type.html("<option value=\"0\">無</option>");
    }


    clear(food_type.parent().parent("tr").find("#amount"), food_type.parent().parent("tr").find("#food_unit"));

    food_type.change(set_sugar_option_value);
}

function set_sugar_option_value(){
    var gram_sugar_value = $("#food_type_option option:selected").attr('gram');
    var set_sugar_value = $("#food_type_option option:selected").attr('set');

    var html = "<option value=\"gram\">公克 < " + gram_sugar_value + "克 ></option>";
    if(set_sugar_value){
        html += "<option value=\"gram\">份 < " + set_sugar_value + "克 ></option>";
    }

    $("#food_unit").html(html);
}

function calc_sugar(){
    var trs = $("#sample > tbody").children("tr");

    var total_sugar = 0.0;
    for(var i = 1; i < trs.length; i++){
        var tr = $(trs[i]);
        var amount = tr.find('td').eq(3).attr("sugar");
        total_sugar += parseFloat(amount);
    }

    if(!isNaN(total_sugar))
        $("#sugar_amount").val(total_sugar);
    else
        $("#sugar_amount").val("0.0");
}

function setFoodList(food_category, food_type, default_value){
    food_category.change({category: food_category,type:food_type,value:default_value},foodHandler);
    food_type.change({type:food_type}, function(event){
        var food_type = event.data.type;
        clear(food_type.parent().parent("tr").find("#amount"), food_type.parent().parent("tr").find("#food_unit"));
    });
}

function setAddFood(food_add_button){
    food_add_button.click({button:food_add_button },function(event){

        event.preventDefault();

        var add_button = event.data.button;
        var tr = add_button.parents("#sample tr");

        var food_category_pk =  tr.find("#food_category").val();
        var food_category_name =  tr.find("#food_category option:selected").text();
        var food_pk =  tr.find("#food_type_option").val();
        var food_name =  tr.find("#food_type_option option:selected").text().split(" ")[0];
        var amount = tr.find("#amount").val();
        var unit = tr.find("#food_unit").val();
        var gram_sugar_value = tr.find("#food_type_option option:selected").attr("gram");
        var set_sugar_value = tr.find("#food_type_option option:selected").attr("set");

        var flag = true;

        if(food_category_pk <= 0){
            tr.find("#food_category").addClass("error");
            flag = false;
        }
        if(food_pk <= 0){
            tr.find("#food_type_option").addClass("error");
            flag = false;
        }
        if(isNaN(amount) || amount <= 0){
            tr.find("#amount").addClass("error");
            flag = false;
        }

        if(flag){
            var new_row = tr.clone();
            new_row.insertAfter('#sample tr:last');

            new_row.find("#delete_food").show();
            new_row.find("#add_food").hide();
            new_row.find('td').eq(1).attr("pk",food_category_pk).html(food_category_name);
            new_row.find('td').eq(2).attr("pk",food_pk).html(food_name);
            if (unit == "gram") {
                var sugar = gram_sugar_value * amount;
                new_row.find('td').eq(3).attr("sugar", sugar).attr("unit","gram").attr("amount",amount).html(amount + " 克");

            }else if (unit == "set") {
                var sugar = set_sugar_value * amount;
                new_row.find('td').eq(3).attr("sugar", sugar).attr("unit","set").attr("amount",amount).html(amount + " 份");
            }

            setfoodRemove(new_row.find("#delete_food"));

            calc_sugar();
            init_food_input();
        }

    });
}

function init_food_input(){
    var tr = $("#sample tr:first");
    tr.find("#food_category").removeClass("error");
    tr.find("#food_type_option").removeClass("error");
    tr.find("#amount").removeClass("error");
    tr.find("#add_food").blur();

    tr.find("#food_category").val("0");
    tr.find("#food_type_option").html("<option value=\"0\">無</option>");
    tr.find("#amount").val("");
    tr.find("#food_unit").val("gram");

}

function setfoodRemove(delete_food){
    delete_food.click({button:delete_food },function(event){
        event.preventDefault();

        var delete_food = event.data.button;
        delete_food.parents("#sample tr").remove();

        calc_sugar();
    });
}

function updateBloodSugar(calendar_date, type, sugar_value) {

    sugar_value = typeof sugar_value !== 'undefined' ? sugar_value : null;

    $("#calendar_date").html(calendar_date);
    $("#range").html(mapping[type]);
    $("#range").attr("value",type);
    $('#timepicker').timepicker('setTime', mapping_time[type]);

    if (sugar_value != null) {
        $.ajax({
            method: "GET",
            url: "/bdata/detail/" + calendar_date + "/" + type
        }).done(function (result) {

            $("#filter").show();
            $("#insert_data").show();
            $("#blood_sugar").val(sugar_value);
            if (result) {
                if (result["measure_time"])
                    $('#timepicker').timepicker('setTime', result["measure_time"].split(" ")[1]);
                else
                    $('#timepicker').timepicker('setTime', mapping_time[type]);

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
            insert_data['calendar_date'] = $("#calendar_date").html();
            insert_data['measure_time'] = $("#calendar_date").html()+" "+$('#timepicker').timepicker('getTime');
            insert_data['measure_type'] = $("#range").attr('value');
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
                url: '/bdata/upsert',
                data: insert_data,
                success: function(result){
                    if(result == "success"){
                        //$("#filter").hide();
                        //$("#insert_data").hide();
                        location.reload();
                    }else{
                        alert("儲存失敗");
                    }
                },
                error: function(){
                    alert("儲存失敗");
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
    $("#food_calendar_date").html(calendar_date);
    $("#food_range").html(mapping[type]);
    $("#food_range").attr("value",type);
    $('#food_timepicker').timepicker('setTime', mapping_time[type]);
    setFoodList($("#food_category"), $("#food_type_option"),1);
    setAddFood($("#add_food"));
    setfoodRemove($("#delete_food"));
    $("#amount").focusout(calc_sugar);
    $("#food_unit").focusout(calc_sugar);

    $.ajax({
        type: 'GET',
        url: '/bdata/food/detail/' + calendar_date + '/' + type,
        success: function(result){
            if(result != null && result["summary"] != null) {
                if (result["summary"]["food_time"])
                    $('#food_timepicker').timepicker('setTime', result["summary"]["food_time"].split(" ")[1]);
                else
                    $('#food_timepicker').timepicker('setTime', mapping_time[type]);
                $("#sugar_amount").val(result["summary"]["sugar_amount"]);

                $("#food_note").val(result["summary"]["food_note"]);
                $("#overall_note").val(result["summary"]["note"]);

                var foods = result["detail"];
                var row_html = $("#sample tr:last");
                for (var i = 0; i < foods.length; i++) {
                    var tmp_row = row_html.clone();
                    tmp_row.insertAfter('#sample tr:last');
                    tmp_row.find("#add_food").hide();
                    tmp_row.find("#delete_food").show();
                    setfoodRemove(tmp_row.find("#delete_food"));
                    tmp_row.find('td').eq(1).attr("pk",foods[i].food_category_pk).html(foods[i].food_category_name);
                    tmp_row.find('td').eq(2).attr("pk",foods[i].food_pk).html(foods[i].food_name);
                    if (foods[i].amount_gram) {
                        tmp_row.find('td').eq(3).attr("sugar", foods[i].sugar).attr("unit","gram").attr("amount",foods[i].amount_gram ).html(foods[i].amount_gram + " 克");
                    }else if (foods[i].amount_set) {
                        tmp_row.find('td').eq(3).attr("sugar", foods[i].sugar).attr("unit","set").attr("amount",foods[i].amount_set).html(foods[i].amount_set + " 份");
                    }

                }
            }
            $("#filter").show();
            $("#insert_food_data").show();
        },
        error: function(){
            $("#filter").show();
            $("#insert_food_data").show();
        }
    });

    $("#food_save").click(function(event){
        var flag = true;

        event.preventDefault();

        var details = [];
        var trs = $("#sample > tbody").children("tr");

        for(var i = 1; i < trs.length; i++){
            var tr = $(trs[i]);
            var food_category = tr.find('td').eq(1).attr("pk");
            var food_type_option = tr.find('td').eq(2).attr("pk");
            var amount = tr.find('td').eq(3).attr("amount");
            var food_unit = tr.find('td').eq(3).attr("unit");

            details.push({'food_category':food_category,
                'food_type_option': food_type_option,
                'amount': amount,
                'food_unit': food_unit
            })
        }

        if(flag){
            var insert_data = {};
            insert_data['calendar_date'] = $("#food_calendar_date").html();
            insert_data['type'] = $("#food_range").attr("value");
            insert_data['food_time'] = $("#food_calendar_date").html() + " " +$("#food_timepicker").timepicker("getTime");
            insert_data['details'] = details;
            insert_data['sugar_amount'] = $("#sugar_amount").val();
            insert_data['food_note'] = $("#food_note").val();
            insert_data['overall_note'] = $("#overall_note").val();
            insert_data['_token'] = $('input[name=_token]').val();

            $.ajax({
                type: 'POST',
                url: '/bdata/upsertfood',
                data: insert_data,
                success: function(result){
                    if(result == "success"){

                        location.reload();
                    }else{
                        alert("儲存失敗");
                    }
                },
                error: function(){
                    alert("儲存失敗");
                }
            });
        }else{
            $("#food_note").focusin();
        }
    });

    $("#food_cancel").click(function(){
        event.preventDefault();
        $("#filter").hide();
        $("#insert_food_data").hide();

        init_food_input();
        var trs = $("#sample > tbody").children("tr");

        for(var i = 1; i < trs.length; i++) {
            $(trs[i]).remove();
        }
        $("#sugar_amount").val("");
        $("#food_note").val("");
        $("#overall_note").val("");

    });

    $("#delete_food_all").click(function(){

        if (confirm("確定要刪除嗎?") == true) {
            $.ajax({
                type: 'DELETE',
                url: '/bdata/foods/'+$("#food_calendar_date").html(),
                data: { _token : $('input[name=_token]').val()},
                success: function(result){
                    if(result == "success"){
                        location.reload();
                    }else{
                        alert("刪除失敗");
                    }
                },
                error: function(){
                    alert("刪除失敗");
                }
            });
        }
        event.preventDefault();
    });
}