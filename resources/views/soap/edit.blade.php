<table class="table table-hover borderless" id="edit_class" style="text-align: center">
    <tr>
        <td>S</td>
        <td>0</td>
        <td>個人化字串</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="s_text">{{$user_data['S']}}</textarea></td>
        <td><textarea class="form-control" style=" height: 150px;" id="o_text">{{$user_data['O']}}</textarea></td>
        <td rowspan="5">
            <select class="form-control" id="customize_type">
                <option value="S">S</option>
                <option value="O">O</option>
                <option value="A">A</option>
                <option value="P">P</option>
                <option value="E">E</option>
                <option value="R">R</option>
            </select>
            <br/>
            <select multiple class="form-control" id="customize_select">
            </select>

            <br/>
            <textarea class="form-control" id="customize_text" style=" height: 150px;"></textarea>
            <br/>
            {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'customize')) !!}
            {!! Form::button('提 交', array('class'=>'btn btn-default', 'id'=>'customize_btn')) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    <tr>
        <td>A</td>
        <td>P</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="a_text">{{$user_data['A']}}</textarea></td>
        <td><textarea class="form-control" style=" height: 150px;" id="p_text">{{$user_data['P']}}</textarea></td>
    </tr>
    <tr>
        <td>E</td>
        <td>R</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="e_text">{{$user_data['E']}}</textarea></td>
        <td><textarea class="form-control" style=" height: 150px;" id="r_text">{{$user_data['R']}}</textarea></td>
    </tr>
    <tr>
        <td colspan="3">
            {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'soap_save')) !!}
            {!! Form::button('儲 存', array('class'=>'btn btn-default', 'id'=>'soap_save_btn', 'style' => 'width: 150px; margin: 0 auto')) !!}
            {!! Form::close() !!}
        </td>
    </tr>
</table>