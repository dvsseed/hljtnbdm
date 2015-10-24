<table class="table table-hover statics">
    <tr>
        <th style="vertical-align: middle; text-align: center;">統計資料</th>
        <th style="vertical-align: middle; text-align: center;">凌晨</th>
        <th style="vertical-align: middle; text-align: center;">晨起</th>
        <th style="vertical-align: middle; text-align: center;">早餐</th>
        <th style="vertical-align: middle; text-align: center;">早點</th>
        <th style="vertical-align: middle; text-align: center;">午餐</th>
        <th style="vertical-align: middle; text-align: center;">午點</th>
        <th style="vertical-align: middle; text-align: center;">晚餐</th>
        <th style="vertical-align: middle; text-align: center;">晚點</th>
        <th style="vertical-align: middle; text-align: center;">睡前</td>
    </tr>
    <tr>
        <td>資料筆數</td>
        <td>@if(isset($food_records['stat']['early_morning']['count'])){{$food_records['stat']['early_morning']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['count'])){{$food_records['stat']['morning']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['count'])){{$food_records['stat']['breakfast_before']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['count'])){{$food_records['stat']['breakfast_after']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['count'])){{$food_records['stat']['lunch_before']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['count'])){{$food_records['stat']['lunch_after']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['count'])){{$food_records['stat']['dinner_before']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['count'])){{$food_records['stat']['dinner_after']['count']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['count'])){{$food_records['stat']['sleep_before']['count']}}@endif</td>
    </tr>
    <tr>
        <td>平均</td>
        <td>@if(isset($food_records['stat']['early_morning']['average'])){{$food_records['stat']['early_morning']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['average'])){{$food_records['stat']['morning']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['average'])){{$food_records['stat']['breakfast_before']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['average'])){{$food_records['stat']['breakfast_after']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['average'])){{$food_records['stat']['lunch_before']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['average'])){{$food_records['stat']['lunch_after']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['average'])){{$food_records['stat']['dinner_before']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['average'])){{$food_records['stat']['dinner_after']['average']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['average'])){{$food_records['stat']['sleep_before']['average']}}@endif</td>
    </tr>
    <tr>
        <td>最大值</td>
        <td>@if(isset($food_records['stat']['early_morning']['max'])){{$food_records['stat']['early_morning']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['max'])){{$food_records['stat']['morning']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['max'])){{$food_records['stat']['breakfast_before']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['max'])){{$food_records['stat']['breakfast_after']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['max'])){{$food_records['stat']['lunch_before']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['max'])){{$food_records['stat']['lunch_after']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['max'])){{$food_records['stat']['dinner_before']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['max'])){{$food_records['stat']['dinner_after']['max']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['max'])){{$food_records['stat']['sleep_before']['max']}}@endif</td>
    </tr>
    <tr>
        <td>最小值</td>
        <td>@if(isset($food_records['stat']['early_morning']['min'])){{$food_records['stat']['early_morning']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['min'])){{$food_records['stat']['morning']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['min'])){{$food_records['stat']['breakfast_before']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['min'])){{$food_records['stat']['breakfast_after']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['min'])){{$food_records['stat']['lunch_before']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['min'])){{$food_records['stat']['lunch_after']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['min'])){{$food_records['stat']['dinner_before']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['min'])){{$food_records['stat']['dinner_after']['min']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['min'])){{$food_records['stat']['sleep_before']['min']}}@endif</td>
    </tr>
    <tr>
        <td>高於目標值</td>
        <td>@if(isset($food_records['stat']['early_morning']['above'])){{$food_records['stat']['early_morning']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['above'])){{$food_records['stat']['morning']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['above'])){{$food_records['stat']['breakfast_before']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['above'])){{$food_records['stat']['breakfast_after']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['above'])){{$food_records['stat']['lunch_before']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['above'])){{$food_records['stat']['lunch_after']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['above'])){{$food_records['stat']['dinner_before']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['above'])){{$food_records['stat']['dinner_after']['above']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['above'])){{$food_records['stat']['sleep_before']['above']}}@endif</td>
    </tr>
    <tr>
        <td>正常值</td>
        <td>@if(isset($food_records['stat']['early_morning']['normal'])){{$food_records['stat']['early_morning']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['normal'])){{$food_records['stat']['morning']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['normal'])){{$food_records['stat']['breakfast_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['normal'])){{$food_records['stat']['breakfast_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['normal'])){{$food_records['stat']['lunch_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['normal'])){{$food_records['stat']['lunch_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['normal'])){{$food_records['stat']['dinner_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['normal'])){{$food_records['stat']['dinner_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['normal'])){{$food_records['stat']['sleep_before']['normal']}}@endif</td>
    </tr>
    <tr>
        <td>低於目標值</td>
        <td>@if(isset($food_records['stat']['early_morning']['below'])){{$food_records['stat']['early_morning']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['morning']['below'])){{$food_records['stat']['morning']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_before']['below'])){{$food_records['stat']['breakfast_before']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['breakfast_after']['below'])){{$food_records['stat']['breakfast_after']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_before']['below'])){{$food_records['stat']['lunch_before']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['lunch_after']['below'])){{$food_records['stat']['lunch_after']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_before']['below'])){{$food_records['stat']['dinner_before']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['dinner_after']['below'])){{$food_records['stat']['dinner_after']['below']}}@endif</td>
        <td>@if(isset($food_records['stat']['sleep_before']['below'])){{$food_records['stat']['sleep_before']['below']}}@endif</td>
    </tr>
</table>