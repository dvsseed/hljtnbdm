$( document ).ready(function() {
    //set up main class
    $("#main_class").find("button").click(function(event){
        event.preventDefault();
        $("#main_class").find(".btn-primary").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        $(this).blur();
        $.ajax({
            type: 'GET',
            url: '/soap/get_sub/' + $(this).attr('data'),
            success: function(result){
                if(result){
                    var html = "";
                    for(var i = 0; i< result.length; i++){
                        html += '<option value="' + result[i].sub_class_pk + '">' + result[i].class_name + '</option>';
                    }

                    $("#sub_class").html(html);
                    if(result.length > 0){
                        setSOAClass(result[0].sub_class_pk);
                    }
                }
            }
        });
    });

    $("#sub_class").change(function(){
        setSOAClass( $(this).val());
    });

    $("#s").click(function(){
        appendText( $(this).find('option:selected').text(), $("#s_text"));
    });

    $("#o").click(function(){
        appendText( $(this).find('option:selected').text(), $("#o_text"));
    });

    $("#a").click(function(){
        setSOADetail( $(this).val() );
        appendText( $(this).find('option:selected').text(), $("#a_text"));
    });

    $("#p").click(function(){
        appendText( $(this).find('option:selected').text(), $("#p_text"));
    });

    $("#e").click(function(){
        appendText( $(this).find('option:selected').text(), $("#e_text"));
    });

    $("#customize_class").change(function(){
        setCustomize($("#customize_class").val(),$("#customize_type").val());
        $("#customize_text").val("");
    });

    $("#customize_type").change(function(){
        setCustomize($("#customize_class").val(),$("#customize_type").val());
        $("#customize_text").val("");
    });

    $("#customize_select").click(function(){
        var select_id = "#" + $("#customize_type").val().toLowerCase() + "_text";
        appendText( $(this).find('option:selected').text(), $(select_id));
    });

    $("#customize_btn").click(function(e){
        e.preventDefault();
        var inputdata = {};
        inputdata['main_class'] = $("#customize_class").val();
        inputdata['types'] = $("#customize_type").val();
        inputdata['text'] = $("#customize_text").val();
        inputdata['_token'] = $('#customize > input[ name=_token]').val();
        $.ajax({
            type: 'POST',
            url: '/soap/get_customize',
            data: inputdata,
            success: function(result){
                if(result == 'success'){
                    setCustomize($("#customize_class").val(),$("#customize_type").val());
                    $("#customize_text").val("");
                    $("#customize_btn").blur();
                }
            }
        });
    });

    $("#soap_save_btn").click(function(e){
        e.preventDefault();
        save_soap(false);
    });

    $("#soap_confirm_btn").click(function(e){
        e.preventDefault();
        save_soap(true);
    });

    setCustomize($("#customize_class").val(), $("#customize_type").val());
});

function save_soap(confirm){

    var inputdata = {};
    inputdata['s_text'] = $("#s_text").val();
    inputdata['o_text'] = $("#o_text").val();
    inputdata['a_text'] = $("#a_text").val();
    inputdata['p_text'] = $("#p_text").val();
    inputdata['e_text'] = $("#e_text").val();
    inputdata['r_text'] = $("#r_text").val();
    inputdata['_token'] = $('#customize > input[ name=_token]').val();
    var soap_nurse_class_pks = [];
    $("input:checkbox[name=nurse]:checked").each(function(){
        soap_nurse_class_pks.push($(this).val());
    });
    inputdata['soa_nurse_class_pks'] = soap_nurse_class_pks.join();

    if(confirm){
        inputdata['confirm'] = true;
    }

    if($("#history_pk").val() != ""){
        inputdata['history'] = $("#history_pk").val();
    }
    $.ajax({
        type: 'POST',
        url: '/soap/post_soap',
        data: inputdata,
        success: function(result){
            var words = result.split(" ");
            if(words[0] == 'success'){
                alert("储存成功");
                var url = window.location.href;
                if(url.indexOf("history=") != -1){
                    window.location.href = words[1];
                }
                $("#soap_save_btn").blur();
                $("#soap_confirm_btn").blur();
            }else{
                alert("储存失败");
                $("#soap_save_btn").blur();
                $("#soap_confirm_btn").blur();
            }
        }
    });
}

function delete_soap(soap_history_pk){

    if (confirm("确定要删除吗?") == true) {
        var inputdata = {};
        inputdata['_token'] = $('#soap_save > input[ name=_token]').val();
        inputdata['history'] = soap_history_pk;
        $.ajax({
            type: 'POST',
            url: '/soap/delete_history/',
            data: inputdata,
            success: function(result){
                if(result == "success"){
                    location.reload();
                }
            }
        });
    }
}

function setSOAClass( sub_class_pk){
    $.ajax({
        type: 'GET',
        url: '/soap/get_soa/' + sub_class_pk,
        success: function(result){
            if(result){
                var html = "";
                var soaps = ["S", "O", "A", "E"];
                for(var j = 0; j < soaps.length; j++){
                    var soap = soaps[j];
                    for(var i = 0; i< result[soap].length; i++){
                        html += '<option value="' + result[soap][i].soa_class_pk + '">' + result[soap][i].class_name + '</option>';
                    }
                    $("#"+soap.toLowerCase()).html(html);

                    html = "";
                }
            }
        }
    });
}

function setSOADetail(soa_class_pk){
    $.ajax({
        type: 'GET',
        url: '/soap/get_soa_detail/' + soa_class_pk,
        success: function(result){
            if(result){
                var html = "";
                for(var i = 0; i< result.length; i++){
                    html += '<option value="' + result[i].soa_detail_pk + '">' + result[i].detail_name + '</option>';
                }
                $("#p").html(html);
            }
        }
    });
}

function setCustomize( main_class, type){
    $.ajax({
        type: 'GET',
        url: '/soap/get_customize/' + main_class + '/' + type,
        success: function(result){
            if(result){
                var html = "";
                for(var i = 0; i< result.length; i++){
                    html += '<option value="' + result[i].user_customize_pk + '">' + result[i].text + '</option>';
                }
                $("#customize_select").html(html);
            }
        }
    });
}

function appendText( text, textarea){
    var old = textarea.val();
    textarea.val( old + get_number(old)+ ". " + text + "\n");
    textarea.scrollTop(textarea[0].scrollHeight);
}

function get_number(text){
    if(text){
        lines = text.split("\n");
        for(var i = lines.length-1; i >= 0; i--){
            heads = lines[i].split(".");
            if(!isNaN(heads[0]) && heads[0] != ""){
                return parseInt(heads[0])+1;
            }
        }
    }

    return 1;
}
//# sourceMappingURL=soap.js.map