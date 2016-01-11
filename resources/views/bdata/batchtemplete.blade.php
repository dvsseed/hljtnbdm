<table class="table borders">
    <th>
        <tr style="background-color: white;">
            <th rowspan="2" style="vertical-align: middle; text-align: center;">检验日期</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">凌晨</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">晨起</th>
            <th colspan="2" style="text-align: center;">早餐</th>
            <th colspan="2" style="text-align: center;">中餐</th>
            <th colspan="2" style="text-align: center;">晚餐</th>
            <th rowspan="2" style="vertical-align: middle;text-align: center;">睡前</th>
        </tr>
        <tr style="background-color: white;">
            <td>饭前</td>
            <td>饭后</td>
            <td>饭前</td>
            <td>饭后</td>
            <td>饭前</td>
            <td>饭后</td>
        </tr>
    </th>
    @foreach ($blood_records as $day)
        <tr>
            <td>{{$day -> calendar_date}}</td>
            <td>{{$day -> early_morning}}</td>
            <td>{{$day -> morning}}</td>
            <td>{{$day -> breakfast_before}}</td>
            <td>{{$day -> breakfast_after}}</td>
            <td>{{$day -> lunch_before}}</td>
            <td>{{$day -> lunch_after}}</td>
            <td>{{$day -> dinner_before}}</td>
            <td>{{$day -> dinner_after}}</td>
            <td>{{$day -> sleep_before}}</td>
            <td>@if(strlen($day->note) <= 13){{$day->note}}@else{{substr($day->note, 0, 10)."..."}}@endif</td>
        </tr>
    @endforeach
    <br/>
    <tr>
        <td colspan="10"><input class=form-control type="button" style="margin: 0 auto; width: 100px;" value="全部删除" id="batch_delete_btn"/></td>
    </tr>
</table>