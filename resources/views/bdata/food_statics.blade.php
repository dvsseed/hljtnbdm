<h3>食物统计</h3>
<span> {{$food_records['start']}} ~ {{$food_records['end']}} </span>
<br/>
<br/>
<table class="table table-hover statics">
    <tr>
        <th style="vertical-align: middle; text-align: center;">统计资料</th>
        <th style="vertical-align: middle; text-align: center;">凌晨</th>
        <th style="vertical-align: middle; text-align: center;">晨起</th>
        <th style="vertical-align: middle; text-align: center;">早餐</th>
        <th style="vertical-align: middle; text-align: center;">早点</th>
        <th style="vertical-align: middle; text-align: center;">午餐</th>
        <th style="vertical-align: middle; text-align: center;">午点</th>
        <th style="vertical-align: middle; text-align: center;">晚餐</th>
        <th style="vertical-align: middle; text-align: center;">晚点</th>
        <th style="vertical-align: middle; text-align: center;">睡前</td>
    </tr>
    <tr>
        <td>资料笔数</td>
        <td>@if(isset($food_records['early_morning']['count'])){{$food_records['early_morning']['count']}}@endif</td>
        <td>@if(isset($food_records['morning']['count'])){{$food_records['morning']['count']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['count'])){{$food_records['breakfast_before']['count']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['count'])){{$food_records['breakfast_after']['count']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['count'])){{$food_records['lunch_before']['count']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['count'])){{$food_records['lunch_after']['count']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['count'])){{$food_records['dinner_before']['count']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['count'])){{$food_records['dinner_after']['count']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['count'])){{$food_records['sleep_before']['count']}}@endif</td>
    </tr>
    <tr>
        <td>平均</td>
        <td>@if(isset($food_records['early_morning']['average'])){{$food_records['early_morning']['average']}}@endif</td>
        <td>@if(isset($food_records['morning']['average'])){{$food_records['morning']['average']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['average'])){{$food_records['breakfast_before']['average']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['average'])){{$food_records['breakfast_after']['average']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['average'])){{$food_records['lunch_before']['average']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['average'])){{$food_records['lunch_after']['average']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['average'])){{$food_records['dinner_before']['average']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['average'])){{$food_records['dinner_after']['average']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['average'])){{$food_records['sleep_before']['average']}}@endif</td>
    </tr>
    <tr>
        <td>最大值</td>
        <td>@if(isset($food_records['early_morning']['max'])){{$food_records['early_morning']['max']}}@endif</td>
        <td>@if(isset($food_records['morning']['max'])){{$food_records['morning']['max']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['max'])){{$food_records['breakfast_before']['max']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['max'])){{$food_records['breakfast_after']['max']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['max'])){{$food_records['lunch_before']['max']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['max'])){{$food_records['lunch_after']['max']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['max'])){{$food_records['dinner_before']['max']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['max'])){{$food_records['dinner_after']['max']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['max'])){{$food_records['sleep_before']['max']}}@endif</td>
    </tr>
    <tr>
        <td>最小值</td>
        <td>@if(isset($food_records['early_morning']['min'])){{$food_records['early_morning']['min']}}@endif</td>
        <td>@if(isset($food_records['morning']['min'])){{$food_records['morning']['min']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['min'])){{$food_records['breakfast_before']['min']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['min'])){{$food_records['breakfast_after']['min']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['min'])){{$food_records['lunch_before']['min']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['min'])){{$food_records['lunch_after']['min']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['min'])){{$food_records['dinner_before']['min']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['min'])){{$food_records['dinner_after']['min']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['min'])){{$food_records['sleep_before']['min']}}@endif</td>
    </tr>
    <tr>
        <td>高于目标值</td>
        <td>@if(isset($food_records['early_morning']['above'])){{$food_records['early_morning']['above']}}@endif</td>
        <td>@if(isset($food_records['morning']['above'])){{$food_records['morning']['above']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['above'])){{$food_records['breakfast_before']['above']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['above'])){{$food_records['breakfast_after']['above']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['above'])){{$food_records['lunch_before']['above']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['above'])){{$food_records['lunch_after']['above']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['above'])){{$food_records['dinner_before']['above']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['above'])){{$food_records['dinner_after']['above']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['above'])){{$food_records['sleep_before']['above']}}@endif</td>
    </tr>
    <tr>
        <td>正常值</td>
        <td>@if(isset($food_records['early_morning']['normal'])){{$food_records['early_morning']['normal']}}@endif</td>
        <td>@if(isset($food_records['morning']['normal'])){{$food_records['morning']['normal']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['normal'])){{$food_records['breakfast_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['normal'])){{$food_records['breakfast_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['normal'])){{$food_records['lunch_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['normal'])){{$food_records['lunch_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['normal'])){{$food_records['dinner_before']['normal']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['normal'])){{$food_records['dinner_after']['normal']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['normal'])){{$food_records['sleep_before']['normal']}}@endif</td>
    </tr>
    <tr>
        <td>低于目标值</td>
        <td>@if(isset($food_records['early_morning']['below'])){{$food_records['early_morning']['below']}}@endif</td>
        <td>@if(isset($food_records['morning']['below'])){{$food_records['morning']['below']}}@endif</td>
        <td>@if(isset($food_records['breakfast_before']['below'])){{$food_records['breakfast_before']['below']}}@endif</td>
        <td>@if(isset($food_records['breakfast_after']['below'])){{$food_records['breakfast_after']['below']}}@endif</td>
        <td>@if(isset($food_records['lunch_before']['below'])){{$food_records['lunch_before']['below']}}@endif</td>
        <td>@if(isset($food_records['lunch_after']['below'])){{$food_records['lunch_after']['below']}}@endif</td>
        <td>@if(isset($food_records['dinner_before']['below'])){{$food_records['dinner_before']['below']}}@endif</td>
        <td>@if(isset($food_records['dinner_after']['below'])){{$food_records['dinner_after']['below']}}@endif</td>
        <td>@if(isset($food_records['sleep_before']['below'])){{$food_records['sleep_before']['below']}}@endif</td>
    </tr>
</table>