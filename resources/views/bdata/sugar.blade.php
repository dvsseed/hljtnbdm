
{!! Html::style('css/bdata.css') !!}
{!! Html::style('css/all.css') !!}
<div id="data" class="content" style="display: none;">
    <div style="text-align: center"><a href="{{$data['previous']}}" style="float: left; margin-bottom: 10px" class="btn btn-default" id="before_two_week">一个月前</a>@if($data['next'] != null)<a href="{{$data['next'] }}" class="btn btn-default" style="float: right; margin-bottom: 10px" id="after_two_week">一个月后</a>@endif
        总次数:{{$stat['total']}} | 次/週:{{$stat['total']/2}}  | 次/日:{{round($stat['total']/14,2)}}
    </div>
    <table class="table table-hover statics" id="sugartable">
        <tr >
            <th rowspan="2" style="vertical-align: middle; text-align: center;">检验日期</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">凌晨</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">晨起</th>
            <th colspan="2" style="text-align: center;">早餐</th>
            <th colspan="2" style="text-align: center;">中餐</th>
            <th colspan="2" style="text-align: center;">晚餐</th>
            <th rowspan="2" style="vertical-align: middle;text-align: center;">睡前</th>
            @if($soap_link != "")<th rowspan="2" style="vertical-align: middle;text-align: center;">备注</th>@endif
        </tr>
        <tr>
            <td>饭前</td>
            <td>饭后</td>
            <td>饭前</td>
            <td>饭后</td>
            <td>饭前</td>
            <td>饭后</td>
        </tr>
        @foreach ($blood_records as $day)
            <tr>
                <td>{{ $day->calendar_date }}</td>
                <td class="form-inline">
                    <div id="normal">
                    @if ($day->early_morning != null)
                        <div class="hover" @if($day->early_morning > 7)style="background-color: #F08080" @elseif($day->early_morning < 3.9)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'early_morning', '{{$day->early_morning}}')" >{{$day->early_morning}}</a>@if(isset($notes[$day->calendar_date]["early_morning"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["early_morning"]}}', event)">*</a>@endif&nbsp;
                    @else
                        <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'early_morning');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                    @endif
                        <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('early_morning', $food_records[$day->calendar_date])) class="change" @endif
                            onclick="insertFood('{{$day->calendar_date}}', 'early_morning');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="early_morning" style="display: none" value="{{$day->early_morning}}"/>
                </td>
                <td>
                    <div id="normal">
                    @if ($day->morning != null)
                        <div class="hover" @if($day->morning > 7)style="background-color: #F08080" @elseif($day->morning < 3.9)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'morning', '{{$day->morning}}')" >{{$day->morning}}</a>@if(isset($notes[$day->calendar_date]["morning"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["morning"]}}', event)">*</a>@endif&nbsp;
                    @else
                        <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'morning');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                    @endif
                        <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('morning', $food_records[$day->calendar_date])) class="change" @endif
                            onclick="insertFood('{{$day->calendar_date}}', 'morning');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="morning" style="display: none" value="{{$day->morning}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->breakfast_before != null)
                            <div class="hover" @if($day->breakfast_before > 7)style="background-color: #F08080" @elseif($day->breakfast_before < 3.9)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_before', '{{$day->breakfast_before}}')" >{{$day->breakfast_before}}</a>@if(isset($notes[$day->calendar_date]["breakfast_before"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["breakfast_before"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_before');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('breakfast_before', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'breakfast_before');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="breakfast_before" style="display: none" value="{{$day->breakfast_before}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->breakfast_after != null)
                            <div class="hover" @if($day->breakfast_after > 9)style="background-color: #F08080" @elseif($day->breakfast_after < 5.6)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_after', '{{$day->breakfast_after}}')" >{{$day->breakfast_after}}</a>@if(isset($notes[$day->calendar_date]["breakfast_after"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["breakfast_after"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'breakfast_after');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('breakfast_after', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'breakfast_after');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="breakfast_after" style="display: none" value="{{$day->breakfast_after}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->lunch_before != null)
                            <div class="hover" @if($day->lunch_before > 7)style="background-color: #F08080" @elseif($day->lunch_before < 3.9)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_before', '{{$day->lunch_before}}')" >{{$day->lunch_before}}</a>@if(isset($notes[$day->calendar_date]["lunch_before"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["lunch_before"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_before');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('lunch_before', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'lunch_before');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="lunch_before" style="display: none" value="{{$day->lunch_before}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->lunch_after != null)
                            <div class="hover" @if($day->lunch_after > 9)style="background-color: #F08080" @elseif($day->lunch_after < 5.6)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_after', '{{$day->lunch_after}}')" >{{$day->lunch_after}}</a>@if(isset($notes[$day->calendar_date]["lunch_after"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["lunch_after"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'lunch_after');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('lunch_after', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'lunch_after');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="lunch_after" style="display: none" value="{{$day->lunch_after}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->dinner_before != null)
                            <div class="hover" @if($day->dinner_before > 7)style="background-color: #F08080" @elseif($day->dinner_before < 3.9)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_before', '{{$day->dinner_before}}')" >{{$day->dinner_before}}</a>@if(isset($notes[$day->calendar_date]["dinner_before"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["dinner_before"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_before');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('dinner_before', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'dinner_before');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="dinner_before" style="display: none" value="{{$day->dinner_before}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->dinner_after != null)
                            <div class="hover" @if($day->dinner_after > 9)style="background-color: #F08080" @elseif($day->dinner_after < 5.6)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_after', '{{$day->dinner_after}}')" >{{$day->dinner_after}}</a>@if(isset($notes[$day->calendar_date]["dinner_after"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["dinner_after"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'dinner_after');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('dinner_after', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'dinner_after');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="dinner_after" style="display: none" value="{{$day->dinner_after}}"/>
                </td>
                <td>
                    <div id="normal">
                        @if ($day->sleep_before != null)
                            <div class="hover" @if($day->sleep_before > 8.3)style="background-color: #F08080" @elseif($day->sleep_before < 5.6)style="background-color: #F0E68C"@endif><a href="#" onclick="updateBloodSugar('{{$day->calendar_date}}', 'sleep_before', '{{$day->sleep_before}}')" >{{$day->sleep_before}}</a>@if(isset($notes[$day->calendar_date]["sleep_before"]))<a href="#" onclick="openDialog('{{$notes[$day->calendar_date]["sleep_before"]}}', event)">*</a>@endif&nbsp;
                        @else
                            <div class="hover"><a href="#" class="change" onclick="updateBloodSugar('{{$day->calendar_date}}', 'sleep_before');" ><img src="/css/images/cross.gif"/></a>&nbsp;&nbsp;
                                @endif
                                <a href="#" @if(!array_key_exists($day->calendar_date, $food_records) || !in_array('sleep_before', $food_records[$day->calendar_date])) class="change" @endif
                                onclick="insertFood('{{$day->calendar_date}}', 'sleep_before');" ><img src="/css/images/rice.gif"/></a></div>
                    </div>
                    <input class="form-control batchInput" id="sugar_batch" type="text" data="sleep_before" style="display: none" value="{{$day->sleep_before}}"/>
                </td>
                @if($soap_link != "")
                    <td>
                        <div id="normal" style="max-width: 150px">
                            @if ($day->note != null)
                                <div class="hover"><a href="#" onclick="updateNote('{{$day->calendar_date}}', this)" title="{{$day->note}}">@if(strlen($day->note) <= 13){{$day->note}}@else{{substr($day->note, 0, 10)."..."}}@endif</a>
                            @else
                                <div class="hover"><a href="#" class="change" onclick="updateNote('{{$day->calendar_date}}');" ><img src="/css/images/note.gif"/></a>&nbsp;&nbsp;
                            @endif
                            </div>
                        </div>
                        <input class="form-control batchInput" id="sugar_batch_empty" type="button" style="display: none" value="清空"/>
                    </td>
                @endif
            </tr>

        @endforeach

        <tr class="statics_data">
            <td>平均</td>
            <td>{{ $stat['avg']['early_morning'] }}</td>
            <td>{{ $stat['avg']['morning'] }}</td>
            <td>{{ $stat['avg']['breakfast_before'] }}</td>
            <td>{{ $stat['avg']['breakfast_after'] }}</td>
            <td>{{ $stat['avg']['lunch_before'] }}</td>
            <td>{{ $stat['avg']['lunch_after'] }}</td>
            <td>{{ $stat['avg']['dinner_before'] }}</td>
            <td>{{ $stat['avg']['dinner_after'] }}</td>
            <td>{{ $stat['avg']['sleep_before'] }}</td>
            <td></td>
        </tr>

        <tr class="statics_data">
            <td>SD</td>
            <td>{{ $stat['deviation']['early_morning'] }}</td>
            <td>{{ $stat['deviation']['morning'] }}</td>
            <td>{{ $stat['deviation']['breakfast_before'] }}</td>
            <td>{{ $stat['deviation']['breakfast_after'] }}</td>
            <td>{{ $stat['deviation']['lunch_before'] }}</td>
            <td>{{ $stat['deviation']['lunch_after'] }}</td>
            <td>{{ $stat['deviation']['dinner_before'] }}</td>
            <td>{{ $stat['deviation']['dinner_after'] }}</td>
            <td>{{ $stat['deviation']['sleep_before'] }}</td>
            <td></td>
        </tr>

        <tr class="batch_save_tr" style="display: none">
            <td colspan="11">
                {!! Form::open(array('url'=>'batch_update','method'=>'POST', 'id'=>'batch_form')) !!}
                {!! Form::button('储存', array('class'=>'btn btn-default', 'id'=>'batch_save_btn', 'style' => 'margin: 0 auto')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    </table>

    <div id="dialog" title="备注">
    </div>
</div>