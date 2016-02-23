/**
 * Created by purplebleed on 2015/9/22.
 */

var mapping = {
    'early_morning': '凌晨',
    'morning': '晨起',
    'breakfast_before': '早餐饭前',
    'breakfast_after': '早餐饭后',
    'lunch_before': '中餐饭前',
    'lunch_after': '中餐饭后',
    'dinner_before': '晚餐饭前',
    'dinner_after': '晚餐饭后',
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
var mapping_range = {
    'early_morning': '00:01~06:00',
    'morning': '06:01~07:00',
    'breakfast_before': '07:01~09:00',
    'breakfast_after': '09:01~11:00',
    'lunch_before': '11:01~13:00',
    'lunch_after': '13:01~17:00',
    'dinner_before': '17:01~19:00',
    'dinner_after': '19:01~20:00',
    'sleep_before': '20:01~00:00'
};
var patt = /\d{4}-\d{2}-\d{2}/;
$( document ).ready(function() {

    $('#sugartable').stickyTableHeaders();

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
        if(link == "#message"){
            setUpMessage();
        }else if(link == "#statics"){
            getStaticsData();
        }else if(link == "#hba1c"){
            getHba1cData();
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
    $("#dialog").dialog({
        autoOpen: false
    });

    if (!Modernizr.inputtypes['date']) {
        $('input[type=date]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }

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

    setContactEditSave();
    setHba1cSave();
    setBatchDeleteQuery();

    Chart.types.Line.extend({
        name: "LineAlt",
        initialize: function (data) {
            Chart.types.Line.prototype.initialize.apply(this, arguments);

            // keep a reference to the original clear
            this.originalClear = this.clear;
            this.clear = function () {
                this.originalClear();

                // 1 x scale unit
                //var unitX = this.datasets[0].points[1].x - this.datasets[0].points[0].x;

                var yTop = this.scale.startPoint;
                var yHeight = this.scale.endPoint - this.scale.startPoint;

                var minVal = this.options.scaleStartValue;
                var maxVal = this.options.scaleSteps + minVal;
                var red_precentage = (maxVal - 9) / this.options.scaleSteps;
                var unit_precentage = 1 / this.options.scaleSteps;

                //console.log(this);

                // change your color here
                this.chart.ctx.fillStyle = 'rgba(250,26,26,1)';

                // we shift it by half a x scale unit to the left because the space between gridline is actually a shared space
                this.chart.ctx.fillRect(this.scale.xScalePaddingLeft, yTop, this.scale.width - (this.scale.xScalePaddingLeft+this.scale.xScalePaddingRight), red_precentage * yHeight);
                this.chart.ctx.fillStyle = 'rgba(250,128,0,1)';
                this.chart.ctx.fillRect(this.scale.xScalePaddingLeft, yTop + red_precentage * yHeight, this.scale.width - (this.scale.xScalePaddingLeft+this.scale.xScalePaddingRight), unit_precentage * yHeight);
                this.chart.ctx.fillStyle =  'rgba(250,255,77,1)';
                this.chart.ctx.fillRect(this.scale.xScalePaddingLeft, yTop + (red_precentage + unit_precentage) * yHeight, this.scale.width - (this.scale.xScalePaddingLeft+this.scale.xScalePaddingRight), unit_precentage * yHeight);
                this.chart.ctx.fillStyle = 'rgba(133,224,26,133)';
                this.chart.ctx.fillRect(this.scale.xScalePaddingLeft, yTop + (red_precentage + 2 * unit_precentage) * yHeight, this.scale.width - (this.scale.xScalePaddingLeft+this.scale.xScalePaddingRight), yHeight * (1-(red_precentage + 2 * unit_precentage)));
                this.chart.ctx.fillStyle = 'rgba(0,0,0,1)';
                this.chart.ctx.fillText("平均血糖", this.scale.xScalePaddingLeft + 4 * this.scale.fontSize - 15, yTop + yHeight + 30);

                /*this.scale.steps = option.scaleEndValue - option.scaleStartValue;
                this.scale.min = option.scaleStartValue;
                this.scale.max = option.scaleEndValue;*/

            }
        }
    });

});

function setBatchDeleteQuery(){
    $("#batch_delete_query").click(function(){
        $.ajax({
            type: 'GET',
            url: '/bdata/query/' + $("#batch_start_date").val() + '/' + $("#batch_end_date").val(),
            success: function (result) {
                $("#batch_delete_result").html(result);
                setDeleteQuery();
            }
        });
    });
}

function setDeleteQuery(){
    $("#batch_delete_btn").click(function(){
        var intput_data = {};
        intput_data['_token'] = $('input[name=_token]').val();
        intput_data['start'] = $("#batch_start_date").val();
        intput_data['end'] = $("#batch_end_date").val();
        $.ajax({
            type: 'POST',
            url: '/bdata/batch_delete',
            data: intput_data,
            success: function (result) {
                if(result == "success"){
                    location.reload();
                    alert("删除成功");
                }else{
                    alert("删除失败");
                }
            },
            error: function(){
                alert("删除失败");
            }
        });
    });
}

function print_page(link){
    $(link).blur();
    window.print();
}

function openDialog(text, event){

    $("#dialog").html(text);
    $("#dialog").dialog("option", "position", {
        my: "left+20 top+10",
        of: event
    });
    $("#dialog").dialog("open");
    $(this).blur();
    event.preventDefault();
}

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

function updateNote(calendar_date, ele){
    var text = "";
    if(ele != null)
        text = $(ele).attr('title');
    $("#day_note").val(text);
    $("#calendar_date_note").html(calendar_date);

    $("#note_filter").show();
    $("#insert_note_data").show();

    $("#save_note").unbind('click').click(function(event){
        var insert_data = {};
        insert_data['day_note'] = $("#day_note").val();
        insert_data['calendar_date'] = calendar_date;
        insert_data['_token'] = $('input[name=_token]').val();
        $.ajax({
            type: 'POST',
            url: '/bdata/upsert_note',
            data: insert_data,
            success: function(result){
                if(result == "success"){
                    location.reload();
                }else{
                    alert("储存失败");
                }
            },
            error: function(){
                alert("储存失败");
            }
        });
        event.preventDefault();
    });

    $("#cancel_note").unbind('click').click(function(event){
        $("#note_filter").hide();
        $("#insert_note_data").hide();
        event.preventDefault();
    });

}

function checkContent(){
    if($(this).attr('id') == 'data'){
        var active = $("#top").find('.active').children('a').attr('href');

        var trs = $("#sugartable > tbody").children("tr");
        for(var i = 0; i < trs.length; i++){
            var tr = $(trs[i]);
            tr.children('td').each (function() {
                if(active == '#data'){
                    $(this).children('#normal').show();
                    $(this).children('#sugar_batch').hide();
                    $(this).children('#sugar_batch_empty').hide();
                }else if(active == '#batchInsert'){
                    $(this).children('#normal').hide();
                    $(this).children('#sugar_batch').show();
                    $(this).children('#sugar_batch').unbind('keydown').keydown(setupKey);
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

            $('#batch_save_btn').unbind('click').click(function(event){
                $(this).prop('disabled', true);
                var flag = true;
                var batch_data = [];
                var trs = $("#sugartable > tbody").children("tr");
                for(var i = 0; i < trs.length; i++){
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
                            alert('储存成功');
                        }else{
                            alert('储存失败');
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

function setupKey( event){
    //top:3
    var bottom = $("#batch_save_btn").closest("tr")[0].rowIndex;

    var now_x = $(this).closest("tr")[0].rowIndex;
    var now_y = $(this).closest("td").index();
    if ( event.which == 37 ) {
        if(now_y > 1){
            now_y -= 1;
        }
    }
    else if ( event.which == 39 ) {
        if(now_y < 9){
            now_y += 1;
        }
    }
    else if ( event.which == 38 ) {
        if(now_x > 4){
            now_x -= 1;
        }
    }
    else if ( event.which == 40 ) {
        if(now_x < bottom){
            now_x += 1;
        }
    }
    $('#sugartable tr:eq(' + now_x + ') td:eq(' + now_y + ')').children('#sugar_batch').focus();
}

function setUpMessage(){
    //setting for message
    $("#messages").css('height', $( window ).height() - $("#top").offset().top - $("#top").height() - 150 );
    $("#reply").unbind('click').click(function(event){
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

            var bs_chart = $('#bs_chart');

            var option = {
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\" style=\"margin-top: 10px;\"><% for (var i=0; i<segments.length; i++){%><li style=\"list-style: none; text-align: left\"><span style=\"background-color:<%=segments[i].fillColor%>; display: block; float: left; height: 16px; width: 16px; margin-right: 15px;\"></span><%if(segments[i].label){%><%=segments[i].label%>  <%=segments[i].value%><%}%></li><%}%></ul>"
            };

            if ( bs_chart.length){
                $.ajax({
                    trpe: 'GET',
                    url: '/bdata/blood/chart',
                    success: function(result){
                        for(var key in mapping){
                            var data = [];
                            var flag = true;
                            if(result[key] == undefined){
                                $("#bs_chart_"+ key).parent().prepend(mapping[key]+"(时间:" + mapping_range[key] + ") 0笔");
                                data = [
                                    {
                                        value: 100,
                                        color:"#888888",
                                        highlight: "#888888",
                                        label: "无"
                                    }
                                ];
                                flag = false;
                            }else{
                                $("#bs_chart_"+ key).parent().prepend(mapping[key]+"(时间:" + mapping_range[key] + ")" + result[key]["count"] + "笔");
                                data = [
                                    {
                                        value: result[key]["above"].split(" ")[0],
                                        color:"#F7464A",
                                        highlight: "#FF5A5E",
                                        label: "高于目标"
                                    },
                                    {
                                        value: result[key]["normal"].split(" ")[0],
                                        color: "#46BFBD",
                                        highlight: "#5AD3D1",
                                        label: "正常值"
                                    },
                                    {
                                        value: result[key]["below"].split(" ")[0],
                                        color: "#FDB45C",
                                        highlight: "#FFC870",
                                        label: "低于目标"
                                    }
                                ];
                            }

                            var ctx = $("#bs_chart_"+ key).get(0).getContext("2d");
                            var myNewChart = new Chart(ctx).Pie(data,option);

                            if(flag){
                                var html = myNewChart.generateLegend();
                                $("#bs_chart_"+ key).parent().append(html);
                            }else{
                                $("#bs_chart_"+ key).parent().css('padding-bottom','60px');
                            }
                        }
                        //console.log(result);
                    }
                })
            }
        }
    });
}

function setHba1cSave(){
    $("#hba1c_goal_save").click(function () {
        inputdata = {};

        inputdata['_token'] = $('#hba1c_goal_form > input[ name=_token]').val();
        inputdata['hba1c_goal'] = $("#hba1c_goal").val();

        $.ajax({
            type: 'POST',
            url: '/bdata/post_hba1c_goal',
            data: inputdata,
            success: function(result){
                if(result == 'success') {
                    alert("储存成功");
                    //location.reload();
                    $("#hba1c_goal_save").blur();
                }
                else{
                    alert("储存失败");
                    $("#hba1c_goal_save").blur();
                }
            }
        });
    });
}

function setContactEditSave(){
    $("#contact_data_save_btn").click(function () {
        inputdata = {};

        inputdata['_token'] = $('#contact_data_save > input[ name=_token]').val();
        inputdata['start_date'] = $("#start_date").val();
        inputdata['med_date'] = $("#med_date").val();
        inputdata['trace_method'] = $("#trace_method").val();
        inputdata['contact_name'] = $("#contact_name").val();
        inputdata['contact_description'] = $("#contact_description").val();
        inputdata['medicine'] = $("#medicine").val();
        inputdata['contact_time'] = $("#contact_time").val();
        inputdata['contact_phone'] = $("#contact_phone").val();
        inputdata['contact_email'] = $("#contact_email").val();
        inputdata['patient_note'] = $('input[name=patient_note]:checked').val();
        if(inputdata['patient_note'] == '其他'){
            inputdata['patient_note'] = $("#patient_input").val();
        }

        $.ajax({
            type: 'POST',
            url: '/bdata/post_contact',
            data: inputdata,
            success: function(result){
                if(result == 'success') {
                    alert("储存成功");
                    $("#contact_data_save_btn").blur();
                    location.reload();
                }
                else{
                    alert("储存失败");
                    $("#contact_data_save_btn").blur();
                }
            },
            statusCode: {
                422: function(result) {

                    var text = JSON.parse(result.responseText);
                    var html = "";
                    console.log(text);
                    for(var key in text){
                        var node = text[key];
                        for(var i = 0;i < node.length; i++){
                            html += (node[i]+'\n');
                        }
                    }
                    alert(html);
                    $("#contact_data_save_btn").blur();
                }
            }
        });
    });

    $("#med_date_after").change(setMedDate);
    $("#start_date").change(setMedDate);

    $("#trace_day").change(function(){
        var days = $("#trace_day").val();
        if(!isNaN(days) && days !=""){
            var today = new Date();
            var today_str =today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate();
            var added_day = addDays(today_str, parseInt(days));
            $("#trace_time").val(formatNumberLength(added_day.getFullYear(),4)+"-"+formatNumberLength(added_day.getMonth()+1,2)+"-"+formatNumberLength(added_day.getDate(),2));
        }
    });
    $("#trace_modify").click(function(){
        inputdata = {}
        inputdata['_token'] = $('#contact_data_save > input[ name=_token]').val();
        inputdata['trace_time'] = $("#trace_time").val();
        $.ajax({
            type: 'POST',
            url: '/bdata/post_contact_trace',
            data: inputdata,
            success: function(result){
                if(result == 'success') {
                    alert("储存成功");
                    $("#trace_modify").blur();
                }
                else{
                    alert("储存失败");
                    $("#trace_modify").blur();
                }
            }
        });
    });
    $("#trace_recover").click(function(){
        $("#trace_time").val($("#trace_time").attr("data"));
    });
}

function setMedDate(){
    var days = $("#med_date_after").val();

    var timestamp=Date.parse($("#start_date").val());
    if (!isNaN(timestamp) && !isNaN(days) && days !=""){
        var added_day = addDays($("#start_date").val(), parseInt(days));
        $("#med_date").val(formatNumberLength(added_day.getFullYear(),4)+"-"+formatNumberLength(added_day.getMonth()+1,2)+"-"+formatNumberLength(added_day.getDate(),2));
    }
}

function formatNumberLength(num, length) {
    var r = "" + num;
    while (r.length < length) {
        r = "0" + r;
    }
    return r;
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

function hba1cToBS(hba1c){
    return Math.round((28.7*hba1c-46.7)/18);
}

function getHba1cData(){
    $("#hba1cChart").width($("#blood_title").width()*0.8);
    $("#hba1cChart").css('margin-left',$("#blood_title").width()*0.1);
    $.ajax({
        type: 'GET',
        url: '/bdata/hba1c',
        success: function(result){
            var data = {
                labels: [],
                datasets: [
                    {
                        label: "HBA1C",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: []
                    }
                ],
                fillBackColor:'rgba(255,0,0,1)'
            };
            var max_avg = 10;
            var min_avg = 5;

            data.labels.push("");
            data.datasets[0].data.push(null);
            var record_data = result["data"];
            if(record_data != null && record_data != undefined){
                for(var i = 0; i < 4; i++){
                    if(i < record_data.length){
                        data.labels.push(record_data[i]["cl_case_date"]+" "+hba1cToBS(record_data[i]["cl_blood_hba1c"]) );
                        data.datasets[0].data.push(record_data[i]["cl_blood_hba1c"]);
                        max_avg = Math.max(record_data[i]["cl_blood_hba1c"], max_avg);
                        min_avg = Math.min(record_data[i]["cl_blood_hba1c"], min_avg);
                    }else{
                        data.labels.push("");
                        data.datasets[0].data.push(null);
                    }
                }
            }
            /*for(var key in result){
                if(key == 'name'){
                    continue;
                }
                if(result[key]["avg"] != null){
                    data.labels.push(result[key]["last_date"].split(" ")[0]+" "+hba1cToBS(result[key]["avg"]) + "     " + result[key]["count"]);
                    data.datasets[0].data.push(result[key]["avg"]);
                    max_avg = Math.max(result[key]["avg"], 10);
                    min_avg = Math.min(result[key]["avg"], 5);
                }else{
                    data.labels.push("");
                    data.datasets[0].data.push(null);
                }
            }*/
            data.labels.push("");
            data.datasets[0].data.push(null);

            var options = {
                scaleSteps: Math.ceil(max_avg - min_avg) ,
                scaleStartValue: Math.floor(min_avg),
                scaleStepWidth: 1,
                scaleOverride: true,
                tooltipTemplate:  function (d) {
                    console.log(d);
                    var words = d.label.split(" ");
                    return d.value;// + " " + words[words.length-1];
                },
                showTooltips: true,
                onAnimationComplete: function()
                {
                    this.showTooltip(this.datasets[0].points, true);
                },
                tooltipEvents: [],
                scaleBackdropPaddingX:10
            };

            var ctx = $("#hba1cChart").get(0).getContext("2d");
            var myNewHba1cChart = new Chart(ctx).LineAlt(data,options);
            $("#hba1c_loading").hide();
            var html = "";

            var record_data = result["data"];
            for( var i = 0; i < record_data.length; i++){
                html += '<tr><td>';
                html += '姓名:&nbsp;' + result['name'] + '&nbsp;&nbsp;日期:&nbsp;&nbsp;' + record_data[i]['cl_case_date'] + '&nbsp; A1C: &nbsp;' + record_data[i]['cl_blood_hba1c'] + ' &nbsp;平均血糖值: &nbsp;' + hba1cToBS(record_data[i]['cl_blood_hba1c']) + '&nbsp;&nbsp;' + getControl(record_data[i]['cl_blood_hba1c']) + '<br/>';
                //html += '總筆數:&nbsp;' + result[key]['count'] + '&nbsp; 資料範圍: &nbsp;' + result[key]['first_date'].split(' ')[0] + '&nbsp;至&nbsp;' + result[key]['last_date'].split(' ')[0];
                html += '</td></tr>';
            }
            /*for(var key in result){

                if(result[key]["avg"] != null){
                    html += '<tr><td>';
                    html += '姓名:&nbsp;' + result['name'] + '&nbsp;&nbsp;最後日期:&nbsp;&nbsp;' + result[key]['last_date'] + '&nbsp; A1C: &nbsp;' + result[key]['avg'] + ' &nbsp;平均血糖值: &nbsp;' + hba1cToBS(result[key]['avg']) + '&nbsp;&nbsp;' + getControl(result[key]['avg']) + '<br/>';
                    html += '總筆數:&nbsp;' + result[key]['count'] + '&nbsp; 資料範圍: &nbsp;' + result[key]['first_date'].split(' ')[0] + '&nbsp;至&nbsp;' + result[key]['last_date'].split(' ')[0];
                    html += '</td></tr>';

                }
            }*/

            $("#hba1c_table").html(html);
        }
    });
}

function getControl(num){
    if(num >= 9)
        return "控制不良";
    else if( num >= 8)
        return "極待加強";
    else if( num >= 7)
        return "待加強";
    else
        return "控制良好";
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
                    html = "<option value=\"0\">无</option>";
                }

                food_type.html(html);

                set_sugar_option_value();
                calc_sugar();
            }
        });
    }
    else{
        food_type.html("<option value=\"0\">无</option>");
    }


    clear(food_type.parent().parent("tr").find("#amount"), food_type.parent().parent("tr").find("#food_unit"));

    food_type.change(set_sugar_option_value);
}

function set_sugar_option_value(){
    var gram_sugar_value = $("#food_type_option option:selected").attr('gram');
    var set_sugar_value = $("#food_type_option option:selected").attr('set');

    var html = "<option value=\"gram\">公克 </option>";
    if(set_sugar_value){
        html += "<option value=\"set\">份 </option>";
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
    tr.find("#food_type_option").html("<option value=\"0\">无</option>");
    tr.find("#amount").val("");
    tr.find("#food_unit").val("gram");

}

function setfoodRemove(delete_food){
    delete_food.unbind("click").click({button:delete_food },function(event){
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

    $("#save").unbind('click').click(function(){

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
            $("#blood_sugar_err").html("必须是数字");
            flag = false;
        }
        if ($('#insulin_type_1').val() != 0 &&  isNaN($('#insulin_value_1').val() / 1)) {
            $("#insulin_1_err").html("必须是数字");
            flag = false;
        }
        if ($('#insulin_type_2').val() != 0 && isNaN($('#insulin_value_2').val() / 1)) {
            $("#insulin_2_err").html("必须是数字");
            flag = false;
        }
        if ($('#insulin_type_3').val() != 0 && isNaN($('#insulin_value_3').val() / 1)) {
            $("#insulin_3_err").html("必须是数字");
            flag = false;
        }
        if (isNaN($('#sugar').val() / 1) ) {
            $("#sugar_err").html("必须是数字");
            flag = false;
        }
        if($("#sport").val() != "none" && $("#duration").val() == "none"){
            $("#sport_err").html("必须填入时间");
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
                        alert("储存失败");
                    }
                },
                error: function(){
                    alert("储存失败");
                }
            });
        }
    });

    $("#cancel").unbind('click').click(function(event){
        event.preventDefault();

        $("#sport").val("none");
        $("#duration").val("none");
        $("#low").val("0");
        $("#blood_sugar").val("");
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

    $("#food_save").unbind('click').click(function(event){
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
                        alert("储存失败");
                    }
                },
                error: function(){
                    alert("储存失败");
                }
            });
        }else{
            $("#food_note").focusin();
        }
    });

    $("#food_cancel").unbind('click').click(function(){
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

    $("#delete_food_all").unbind('click').click(function(){

        if (confirm("确定要删除吗?") == true) {
            $.ajax({
                type: 'DELETE',
                url: '/bdata/foods/'+$("#food_calendar_date").html(),
                data: { _token : $('input[name=_token]').val()},
                success: function(result){
                    if(result == "success"){
                        location.reload();
                    }else{
                        alert("删除失败");
                    }
                },
                error: function(){
                    alert("删除失败");
                }
            });
        }
        event.preventDefault();
    });
}

function filter(text, event){
    if(text != ""){
        var insert_data = {"filter": text};
        $.ajax({
            type: 'GET',
            url: '/bdata/filter',
            data: insert_data,
            success: function(result){
                if(result){
                    $("#filter_data").html(result);
                }
            },
            error: function(){
            }
        });
    }
    event.preventDefault();
}
//# sourceMappingURL=bdata.js.map
