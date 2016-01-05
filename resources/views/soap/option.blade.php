{!! Html::style('css/bdata.css') !!}

<table class="table borderless" id="other_class" style="text-align: center; background-color: lightpink">
    <tr>
        <td class="col-md-3">
            <table class="table" id="sub_class_table" >
                @for($i = 0; $i < count($sub_classes); $i += 4)
                    <tr class="form-inline">
                    @for($j = 0; $j < 4 && $i + $j < count($sub_classes); $j++)
                        <td class="form-inline" style="text-align: center"><input type="radio" @if($i == 0 && $j == 0) checked @endif name="sub_class"  value="{{$sub_classes[$i + $j] -> sub_class_pk}}"/>&nbsp;&nbsp;{{$sub_classes[$i + $j] -> class_name}}</td>
                    @endfor
                    </tr>
                @endfor
            </table>
        </td>
        <td rowspan="11">
            护理卫教项目
            <table >
                @foreach($soa_nurse_classes[0] as $soa_nurse_class)
                    <tr><td style="text-align: left"><input type="checkbox" name="nurse" value="{{$soa_nurse_class -> soa_nurse_class_pk}}" @if(in_array($soa_nurse_class -> soa_nurse_class_pk,$user_soa_nurse_pks)) checked @endif/>{{$soa_nurse_class -> name}}</td></tr>
                @endforeach
            </table>
            <br/>
            营养卫教项目
            <table style="text-align: left">
                @foreach($soa_nurse_classes[1] as $soa_nurse_class)
                    <tr><td style="text-align: left"><input type="checkbox" name="nurse" value="{{$soa_nurse_class -> soa_nurse_class_pk}}" @if(in_array($soa_nurse_class -> soa_nurse_class_pk,$user_soa_nurse_pks)) checked @endif/>{{$soa_nurse_class -> name}}</td></tr>
                @endforeach
            </table>
            <br/>
            个人化字串
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
            <br/>
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