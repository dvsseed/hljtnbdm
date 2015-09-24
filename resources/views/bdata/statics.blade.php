
{!! Html::style('css/bdata.css') !!}

<div id="data" class="content" style="display: block">
    <table class="table table-hover statics">
        <tr >
            <th rowspan="2" style="vertical-align: middle">檢驗日期</th>
            <th rowspan="2" style="vertical-align: middle">凌晨</th>
            <th rowspan="2" style="vertical-align: middle">晨起</th>
            <th colspan="2" >早餐</th>
            <th colspan="2" >中餐</th>
            <th colspan="2" >晚餐</th>
            <th rowspan="2" style="vertical-align: middle">睡前</th>
            <th rowspan="2" style="vertical-align: middle">備註</th>
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
                <td>{{ $day->early_morning }}</td>
                <td>{{ $day->morning }}</td>
                <td>{{ $day->breakfast_before }}</td>
                <td>{{ $day->breakfast_after }}</td>
                <td>{{ $day->lunch_before }}</td>
                <td>{{ $day->lunch_after }}</td>
                <td>{{ $day->dinner_brfore }}</td>
                <td>{{ $day->dinner_after }}</td>
                <td>{{ $day->sleep_before }}</td>
                <td>{{ $day->note }}</td>
            </tr>

        @endforeach
    </table>
</div>