{!! Html::style('css/bdata.css') !!}

<table class="table borderless" id="other_class" style="text-align: center; background-color: lightpink">
    <tr >
        <td></td>
        <td>个人化字串</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select id="sub_class" class="form-control" >
                @foreach($sub_classes as $sub_class)
                    <option value="{{$sub_class -> sub_class_pk}}">{{$sub_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td rowspan="11">
            <select class="form-control" id="customize_class">
                @foreach($main_classes as $main_class)
                    <option value="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</option>
                @endforeach
            </select>
            <br/>
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
        <td>S</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="s" style="overflow-x: auto; height: 120px; width: 450px">
                @foreach($soa_classes['S'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>O</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="o" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['O'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>A</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="a" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['A'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>P</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="p" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['P'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>E</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="e" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['E'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>