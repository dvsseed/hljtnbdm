<table>
    <tr>
        <th colspan="{{count($records)*4}}" style="font-weight:bold">{{$chart_title}}</th>
    </tr>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) 区间 @else {{$data['title']}} @endif</th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) {{$data['title']}} @endif</th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif></th>
            <th style="min-width: 100px" @if(isset($xls)) width="20px" @endif></th>
        @endforeach
    </tr>
    <tr>
        @foreach($records as $key=>$data)
            <td style="font-weight:bold">总笔数</td>
            <td>{{$data['data']['count']}}</td>
            <td></td>
            <td style="font-weight:bold">百分比</td>
        @endforeach
    </tr>
    @if($longest != -1)
        @for($i = 0; $i < $longest; $i++)
            <tr>
                @foreach($records as $key=>$data)
                    <td></td>
                    @if(isset($data['data'][$i]))
                        <td>@if(isset($xls)) {{$data['data'][$i]['nurse']}} @else <a href="{{$base}}/{{$data['data'][$i]['nurse_detail']}}" >{{$data['data'][$i]['nurse']}}</a> @endif</td>
                        <td>{{$data['data'][$i]['count']}}</td>
                        <td>{{round(100*$data['data'][$i]['count']/$data['data']['count'])}}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endfor
    @endif
</table>
