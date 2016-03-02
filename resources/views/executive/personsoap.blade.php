<table>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) 区间 @else {{$data['title']}} @endif</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>@if($first_key == $key) {{$data['title']}} @endif</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>权责区分</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>姓名</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>人数</th>
            <th style="min-width: 100px;font-weight:bold" @if(isset($xls)) width="20px" @endif>百分比</th>
        @endforeach

    </tr>
    @if($longest != -1)
        @for($i = 0; $i < $longest; $i++)
            <tr>
                @foreach($records as $key=>$data)
                    <td style="font-weight: bold">@if($i == 0) 人数 @endif</td>
                    @if(isset($data['data'][$i]))
                        <td>@if($i == 0) {{$data['data'][$i]['total']}} @endif</td>
                        <td>权责卫教师</td>
                        <td>{{$data['data'][$i]['nurse']}}</td>
                        <td>{{$data['data'][$i]['count']}}</td>
                        <td>{{round(100*$data['data'][$i]['count']/$data['data'][$i]['total'])}}</td>
                    @else
                        <td></td>
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