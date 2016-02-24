<table class="table borderless" id="edit_class" style="text-align: center">
    <tr>
        <td style="text-align: left">衛教備註</td>
    </tr>
    <tr>
        <td style="text-align: left"><a href={{$burl}}>{!! nl2br($memo) !!}</a></td>
    </tr>
    <tr>
        <td>S</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="s_text">{{$user_data['S']}}</textarea></td>
    </tr>
    <tr>
        <td>O</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="o_text">{{$user_data['O']}}</textarea></td>
    </tr>
    <tr>
        <td>A</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="a_text">{{$user_data['A']}}</textarea></td>
    </tr>
    <tr>
        <td>P</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="p_text">{{$user_data['P']}}</textarea></td>
    </tr>
    <tr>
        <td>E</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="e_text">{{$user_data['E']}}</textarea></td>
    </tr>
    <tr>
        <td>R</td>
    </tr>
    <tr>
        <td><textarea class="form-control" style=" height: 150px;" id="r_text">{{$user_data['R']}}</textarea></td>
    </tr>
    <tr>
        <td>
            {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'soap_save')) !!}
            {!! Form::button('暂 存', array('class'=>'btn btn-default', 'id'=>'soap_save_btn', 'style' => 'width: 150px; margin: 0 auto')) !!}
            {!! Form::button('完 成', array('class'=>'btn btn-default', 'id'=>'soap_confirm_btn', 'style' => 'width: 150px; margin: 0 auto')) !!}
            <a href="/soap_history/{{$uuid}}" class="btn btn-default" style="width: 150px;">历史纪录</a>
            {!! Form::close() !!}
        </td>
    </tr>
</table>