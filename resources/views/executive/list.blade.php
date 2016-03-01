<table>
    <tr>
        <th colspan="{{count($records)*4}}">{{$chart_title}}</th>
    </tr>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) 区间 @else {{$data['title']}} @endif </th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) {{$data['title']}} @endif</th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif></th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif></th>
        @endforeach
    </tr>
    @if($longest != -1)
        @for($i = 0; $i < $longest; $i++)
            <tr>
                @foreach($records as $key=>$data)
                    @if(isset($data['data'][$i]))
                        <td style="font-weight: bold">{{$data['data'][$i][0]}}</td>
                        <td> @if(isset($data['data'][$i]['doctor_detail']) && !isset($xls)) <a href="{{$base}}/{{$data['data'][$i]['doctor_detail']}}">{{$data['data'][$i][1]}}</a> @else {{$data['data'][$i][1]}} @endif</td>
                        <td>{{$data['data'][$i][2]}}</td>
                        <td>{{$data['data'][$i][3]}}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endfor
    @endif

</table>
