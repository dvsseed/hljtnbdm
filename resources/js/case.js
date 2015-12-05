$(function() {
    $("#cl_case_date").datepicker( {
    });

    $("#cl_foot_chk_right0").click(function() {
        alert('hi');
        if($(this).is(":checked")) {
            var returnVal = confirm("Are you sure?");
            $(this).attr("checked", returnVal);
        }
        $('#textbox1').val($(this).is(':checked'));
    });

    $("#cl_foot_chk_right0").on("change", function() {
        alert('hi');
        if(this.checked) {
            $("#cl_foot_chk_right1").attr("disabled", false);
            $("#cl_foot_chk_right2").attr("disabled", false);
            $("#cl_foot_chk_right3").attr("disabled", false);
            $("#cl_foot_chk_right4").attr("disabled", false);
            $("#cl_foot_chk_right5").attr("disabled", false);
        } else {
            $("#cl_foot_chk_right1").attr("disabled", true);
            $("#cl_foot_chk_right2").attr("disabled", true);
            $("#cl_foot_chk_right3").attr("disabled", true);
            $("#cl_foot_chk_right4").attr("disabled", true);
            $("#cl_foot_chk_right5").attr("disabled", true);
            $("#cl_foot_chk_right1").attr("checked", false);
            $("#cl_foot_chk_right2").attr("checked", false);
            $("#cl_foot_chk_right3").attr("checked", false);
            $("#cl_foot_chk_right4").attr("checked", false);
            $("#cl_foot_chk_right5").attr("checked", false);
        }
    });

});

function updateTxtContent(val){
    if (val == '') {
        $("#caseis1409").hide();
        $("#casegeneral1408").hide();
    } else {
        if (val == 4) {
            $("#caseis1409").hide();
            $("#casegeneral1408").show();
        } else {
            $("#caseis1409").show();
            $("#casegeneral1408").hide();
        }
    }
}
