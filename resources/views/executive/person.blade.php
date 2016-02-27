<table>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) 區間 @else {{$data['title']}} @endif</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) {{$data['title']}} @endif</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>權責區分</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>姓名</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>人數</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>百分比</th>
        @endforeach

    </tr>
    @if($longest != -1)
        @for($i = 0; $i < $longest; $i++)
            <tr>
                @foreach($records as $key=>$data)
                    @if(isset($data['data'][$i]))
                        <td style="font-weight: bold">@if($i == 0) 人數 @endif</td>
                        <td>@if($i == 0) {{$data['data']['count']}} @endif</td>
                        <td style="font-weight: bold">{{$data['data'][$i][0]}}</td>
                        <td>{{$data['data'][$i][1]}}</td>
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