
{!! Html::style('css/bdata.css') !!}
{!! Html::style('css/all.css') !!}

<div id="data" class="content" style="display: block">
    <table class="table table-hover statics" >
        <tr >
            <th rowspan="2" style="vertical-align: middle; text-align: center;">檢驗日期</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">凌晨</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">晨起</th>
            <th colspan="2" style="text-align: center;">早餐</th>
            <th colspan="2" style="text-align: center;">中餐</th>
            <th colspan="2" style="text-align: center;">晚餐</th>
            <th rowspan="2" style="vertical-align: middle;text-align: center;">睡前</th>
            <th rowspan="2" style="vertical-align: middle;text-align: center;">備註</th>
        </tr>
        <tr>
            <td>飯前</td>
            <td>飯後</td>
            <td>飯前</td>
            <td>飯後</td>
            <td>飯前</td>
            <td>飯後</td>
        </tr>
        @foreach ($blood_records as $day)
            <tr>
                <td>{{ $day->calendar_date }}</td>
                <td>
                    @if ($day->early_morning != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'early_morning', {{$day->early_morning}})" >{{$day->early_morning}}@if($day->note != null)*@endif</a>
                    @else
                        <div class="hover"><a href="#"  onclick="updateBloodSugar('{{$day->calendar_date}}', 'early_morning');" ><img src="/img/cross.gif"/></a>&nbsp;&nbsp;
                        <a href="#"  onclick="insertFood('{{$day->calendar_date}}', 'early_morning');" ><img src="/img/rice.gif"/></a></div>
                    @endif
                </td>
                <td>
                    @if ($day->morning != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'morning', {{$day->morning}})" >{{$day->morning}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'morning');" >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->breakfast_before != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_before', {{$day->breakfast_before}})" >{{$day->breakfast_before}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_before'); " >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->breakfast_after != null)
                        <a href=#"" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_after', {{$day->breakfast_after}})" >{{$day->breakfast_after}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_after');" >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->lunch_before != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_before', {{$day->lunch_before}})" >{{$day->lunch_before}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_before');" >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->lunch_after != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_after', {{$day->lunch_after}})" >{{$day->lunch_after}}@if($day->note != null)*@endif</a>
                    @else
                        <a href=#"" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_after'); " >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->dinner_brfore != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_brfore', {{$day->dinner_brfore}}; event.preventDefault();)" >{{$day->dinner_brfore}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_brfore'); " >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->dinner_after != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_after', {{$day->dinner_after}}); event.preventDefault();" >{{$day->dinner_after}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_after'); " >--</a>
                    @endif
                </td>
                <td>
                    @if ($day->sleep_before != null)
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'sleep_before', {{$day->sleep_before}})" >{{$day->sleep_before}}@if($day->note != null)*@endif</a>
                    @else
                        <a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'sleep_before'); " >--</a>
                    @endif
                </td>
                <td>{{ $day->note }}</td>
            </tr>

        @endforeach
    </table>
</div>