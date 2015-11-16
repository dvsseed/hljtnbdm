<div id="filter" class="" style="display: none; position: absolute; top: 0px; left: 0px; width: 100%; height: 150%; background-color: black; opacity: 0.9; filter: alpha(opacity=90)">

</div>
<div id="insert_data" style="background-color: whitesmoke; width: 80%;  left: 10%; top:10%; position: absolute; display: none;">
    <table class="table table-hover" style="width: 80%;  margin: 0px auto; ">
        <tr>
            <td>量测日期：</td><td id="calendar_date"></td>
        </tr>
        <tr>
            <td>量测时间：</td><td class="form-inline"><input type="text" id="timepicker" class="form-control" style="width: 100px"/></td>
        </tr>
        <tr>
            <td>量测时段：</td><td id="range"></td>
        </tr>
        <tr>
            <td style="vertical-align: middle" >血 糖：</td><td class="form-inline"><input type="text" id="blood_sugar" class="form-control" style="width: 100px"/> mmol/l
                <div id="blood_sugar_err" style="color: red">&nbsp;</div></td>
        </tr>
        <tr>
            <td style="vertical-align: middle">运 动：</td><td class="form-inline">
                <select id="sport" class="form-control" style="width: 150px">
                    <option value="none">无</option>
                    <option value="slight">轻度运动</option>
                    <option value="medium">中度运动</option>
                    <option value="heavy">重度运动</option>
                </select>
                <select id="duration" class="form-control" style="width: 150px">
                    <option value="none">时间</option>
                    <option value="0.5">0.5小时</option>
                    <option value="1">1小时</option>
                    <option value="1.5">1.5小时</option>
                    <option value="2">2小时</option>
                    <option value="2.5">2.5小时</option>
                    <option value="3">3小时</option>
                    <option value="3.5">3.5小时</option>
                    <option value="4">4小时</option>
                    <option value="4.5">4.5小时</option>
                </select>
                <div id="sport_err" style="color: red">&nbsp;</div></td>
        </tr>
        <tr>
            <td>低血糖：</td><td class="form-inline">
                <select id="low" class="form-control" style="width: 150px">
                    <option value="0">无</option>
                    <option value="1">有</option>
                </select>
            </td>
        </tr>
        <tr>
            <td rowspan="3" style="vertical-align:middle;">胰岛素：</td><td class="form-inline">
                <select id="insulin_type_1" class="form-control" style="width: 150px">
                    <option value="0" selected="">无</option>
                    <option value="1">速效</option>
                    <option value="2">短效</option>
                    <option value="3">中效</option>
                    <option value="4">长效</option>
                    <option value="5">溷合型70/30</option>
                    <option value="6">溷合型75/25</option>
                    <option value="7">帮浦</option>
                    <option value="8">口服药</option>
                </select>
                <input id="insulin_value_1" type="text" class="form-control">单位
                <div id="insulin_1_err" style="color: red">&nbsp;</div></td>
            </td>
        </tr>
        <tr>
            <td class="form-inline">
                <select id="insulin_type_2" class="form-control" style="width: 150px">
                    <option value="0" selected="">无</option>
                    <option value="1">速效</option>
                    <option value="2">短效</option>
                    <option value="3">中效</option>
                    <option value="4">长效</option>
                    <option value="5">溷合型70/30</option>
                    <option value="6">溷合型75/25</option>
                    <option value="7">帮浦</option>
                    <option value="8">口服药</option>
                </select>
                <input id="insulin_value_2" type="text" class="form-control">单位
                <div id="insulin_2_err" style="color: red">&nbsp;</div></td>
        </tr>
        <tr>
            <td class="form-inline">
                <select id="insulin_type_3" class="form-control" style="width: 150px">
                    <option value="0" selected="">无</option>
                    <option value="1">速效</option>
                    <option value="2">短效</option>
                    <option value="3">中效</option>
                    <option value="4">长效</option>
                    <option value="5">溷合型70/30</option>
                    <option value="6">溷合型75/25</option>
                    <option value="7">帮浦</option>
                    <option value="8">口服药</option>
                </select>
                <input id="insulin_value_3" type="text" class="form-control">单位
                <div id="insulin_3_err" style="color: red">&nbsp;</div>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle;">饮食醣份：</td><td class="form-inline"><input id="sugar" type="text" class="form-control">克
                <div id="sugar_err" style="color: red">&nbsp;</div>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle;">我的备注：</td><td class="form-inline"><textarea id="note" style="width: 330px; height: 150px" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                {!! Form::open(array('url'=>'upsert','method'=>'POST', 'id'=>'myform')) !!}
                {!! Form::button('存 档', array('class'=>'btn btn-default', 'id'=>'save')) !!}
                <button class="btn btn-default" id="cancel">取 消</button>
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
</div>