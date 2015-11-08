<div id="note_filter" class="" style="display: none; position: absolute; top: 0px; left: 0px; width: 100%; height: 150%; background-color: black; opacity: 0.9; filter: alpha(opacity=90)">

</div>
<div id="insert_note_data" style="background-color: whitesmoke; width: 80%;  left: 10%; top:30%; position: absolute; display: none;">
    <table class="table table-hover" style="width: 80%;  margin: 0px auto; ">
        <tr>
            <td>日 期：</td><td id="calendar_date_note"></td>
        </tr>
        <tr>
            <td style="vertical-align:middle;">備 註：</td><td class="form-inline"><textarea id="day_note" style="width: 330px; height: 150px" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                {!! Form::open(array('url'=>'upsert','method'=>'POST', 'id'=>'mynoteform')) !!}
                {!! Form::button('存 檔', array('class'=>'btn btn-default', 'id'=>'save_note')) !!}
                <button class="btn btn-default" id="cancel_note">取 消</button>
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
</div>