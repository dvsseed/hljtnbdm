{!! Html::style('css/bdata.css') !!}

<table class="table borderless" id="main_class">
    <tr>
        @foreach($main_classes as $main_class)
            @if($main_class -> main_class_pk == 1)
                <td><button class="form-control btn-primary" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
            @else
                <td><button class="form-control" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
            @endif
        @endforeach
    </tr>
</table>
<table class="table borderless" id="other_class" style="text-align: center; background-color: lightpink">
    <tr >
        <td></td>
        <td>S</td>
        <td>O</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select id="sub_class" class="form-control" >
                @foreach($sub_classes as $sub_class)
                    <option value="{{$sub_class -> sub_class_pk}}">{{$sub_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td class="col-md-3">
            <select multiple class="form-control" id="s" >
                @foreach($soa_classes['S'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td class="col-md-3">
            <select multiple class="form-control" id="o">
                @foreach($soa_classes['O'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>A</td>
        <td>P</td>
        <td>E</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select multiple class="form-control" id="a">
                @foreach($soa_classes['A'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td class="col-md-3">
            <select multiple class="form-control" id="p">
                @foreach($soa_classes['P'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td class="col-md-3">
            <select multiple class="form-control" id="e">
                @foreach($soa_classes['E'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>