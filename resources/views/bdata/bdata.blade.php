@extends('master')

@section('title')
    血糖资料
@stop

@section('content')

    <div class="container-fluid">
        <h3 align="center" id="blood_title">血糖资料</h3>
        <br/>
        <div class="row">
            <div class="col-md-2"><h4>病历号码</h4></div>
            <div class="col-md-3"><h4>{{$data['displayname']}}</h4></div>
            <div class="col-md-1"><h4>姓 名</h4></div>
            <div class="col-md-3"><h4>{{$data['patient_displayname']}}</h4></div>
            <div class="col-md-1"><h4>生 日</h4></div>
            <div class="col-md-2"><h4>{{$data['patient_bday']}} , {{$data['patient_age']}}岁</h4></div>
        </div>
        <br/>
        @if($contact_data != null)
        <table class="table">
            <tr>
                <td>卫教师</td>
                <td>追踪方式</td>
                <td>连络时段</td>
                <td>电话</td>
                <td>电子邮件</td>
                <td>连络人</td>
                <td>备注</td>
                <td>起始日期</td>
                <td>结束日期</td>
                <td>用药</td>
                <td>病人注记</td>
            </tr>
            <tr>
                <td>{{$contact_data["nurse_name"]}}</td>
                <td>{{$contact_data["trace_method"]}}</td>
                <td>{{$contact_data["contact_time"]}}</td>
                <td>{{$contact_data["contact_phone"]}}</td>
                <td>{{$contact_data["contact_email"]}}</td>
                <td>{{$contact_data["contact_name"]}}</td>
                <td>{!! nl2br($contact_data["contact_description"]) !!}</td>
                <td>{{$contact_data["start_date"]}}</td>
                <td>{{$contact_data["med_date"]}}</td>
                <td>{!! nl2br($contact_data["medicine"]) !!}</td>
                <td>{{$contact_data["patient_note"]}}</td>
            </tr>
            <tr>
                <td>预定追踪日期</td>
                <td class="form-inline" colspan="9" style="text-align: left;">
                    <input class="form-control" type="date" id="trace_time" value="@if($contact_data['trace_time'] != null && $contact_data['trace_time'] != '0000-00-00'){{$contact_data['trace_time']}}@else{{$contact_data['start_date']}}@endif" data="@if($contact_data['trace_time'] != null && $contact_data['trace_time'] != '0000-00-00'){{$contact_data['trace_time']}}@else{{$contact_data['start_date']}}@endif"/>
                    今日加
                    <input class="form-control" type="text" id="trace_day"/>
                    天
                    <input class="form-control" type="button" value="修改" id="trace_modify"/>
                    <input class="form-control" type="button" value="復原" id="trace_recover"/>
                </td>
            </tr>
        </table>
        @endif
        <br/>
        <ul class="nav nav-tabs" id="top">
            <li role="presentation"><a class="menuLink" href="#data">区间资料</a></li>
            <li role="presentation"><a id="batch" class="menuLink" href="#batchInsert">批次输入</a></li>
            <li role="presentation"><a id="batch" class="menuLink" href="#batchDelete">批次刪除</a></li>
            <li role="presentation"><a class="menuLink" href="#statics">统计资料</a></li>
            @if($soap_link != "")
                <li role="presentation"><a class="menuLink real" href="{{$soap_link}}">SOAP</a></li>
            @endif
            <li role="presentation"><a class="menuLink" href="#hba1c">HbA1C</a></li>
            <li role="presentation"><a class="menuLink" href="#message">留言</a></li>
            <li role="presentation"><a class="menuLink" href="#goal">血糖目标</a></li>
            <li role="presentation"><a class="menuLink real" href="/case/create/{{$data['patient_id']}}">方案</a></li>
            <li role="presentation"><a class="menuLink real" href="/patient/ccreate/{{$data['patient_id']}}">患者资料</a></li>
            <li role="presentation"><a class="menuLink" href="#contactedit">联络资料</a></li>
            <li role="presentation"><a class="no-hover" href="#" onclick="print_page(this)">列印本页</a></li>
        </ul>
        <br/>

        @include('bdata.sugar')

        @include('bdata.batchDelete')

        @include('bdata.statics')

        @include('bdata.hba1c')

        @include('bdata.message')

        @include('bdata.goal')

        @include('bdata.contactedit')
        <div id="hba1c" class="content" style="display: none">
            <table class="table table-hover">
                <tr>
                    <th></th>
                    <th>时间</th>
                </tr>
            </table>
        </div>
    </div>
    @include('bdata.insert')
    @include('bdata.insertfood')
    @include('bdata.insertnote')


@stop

@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/chart.js') !!}
    {!! Html::script('js/timepicker.js') !!}
    {!! Html::script('js/bdata.js') !!}
    {!! Html::script('js/modernizr.min.js') !!}
    {!! Html::script('js/jquery.stickytableheaders.min.js') !!}
@stop