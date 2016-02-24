<meta charset="UTF-8">
<table>
    <tr>
        @foreach($records as $key=>$data)
            @if($first_key = key($data)) @endif
            <td>
                <table>
                    <tr>
                        <th colspan="4">{{$chart_title}}</th>
                    </tr>
                    <tr>
                        <th>@if($first_key == $key) 區間 @else {{$data['title']}} @endif</th>
                        <th>@if($first_key == $key) {{$data['title']}} @endif</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>總筆數</td>
                        <td>{{$data['data']['count']}}</td>
                        <td></td>
                        <td>百分比</td>
                    </tr>
                    @if(isset($data['data']))
                        @foreach($data['data']['nurse'] as $nurse => $count)
                            <tr>
                                <td></td>
                                <td>{{$nurse}}</td>
                                <td>{{$count}}</td>
                                <td>{{$count}}/{{$data['data']['count']}}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        @endforeach
    </tr>
</table>