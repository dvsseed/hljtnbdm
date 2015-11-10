<h3>血糖資料</h3>
<br/>
<br/>
<table class="table statics">
    <tr >
        <th rowspan="2" style="vertical-align: middle; text-align: center;">檢驗日期</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">凌晨</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">晨起</th>
        <th colspan="2" style="text-align: center;">早餐</th>
        <th colspan="2" style="text-align: center;">中餐</th>
        <th colspan="2" style="text-align: center;">晚餐</th>
        <th rowspan="2" style="vertical-align: middle;text-align: center;">睡前</th>
    </tr>
    <tr>
        <th style="vertical-align: middle; text-align: center;">飯前</th>
        <th style="vertical-align: middle; text-align: center;">飯後</th>
        <th style="vertical-align: middle; text-align: center;">飯前</th>
        <th style="vertical-align: middle; text-align: center;">飯後</th>
        <th style="vertical-align: middle; text-align: center;">飯前</th>
        <th style="vertical-align: middle; text-align: center;">飯後</th>
    </tr>
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
        </tr>
    @endforeach
 </table>
<br/>
<br/>