@extends('master')

@section('title')
    血糖资料
@stop

@section('content')

    <div class="container">
        <h3 align="center">血糖资料</h3>
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
        <ul class="nav nav-tabs" id="top">
            <li role="presentation"><a class="menuLink" href="#data">区间资料</a></li>
            <li role="presentation"><a id="batch" class="menuLink" href="#batchInsert">批次输入</a></li>
            <li role="presentation"><a class="menuLink" href="#statics">统计资料</a></li>
            @if($soap_link != "")
                <li role="presentation"><a class="menuLink real" href="{{$soap_link}}">SOAP</a></li>
            @endif
            <li role="presentation"><a class="menuLink" href="#hba1c">HbA1C</a></li>
            <li role="presentation"><a class="menuLink" href="#message">留言</a></li>
            <li role="presentation"><a class="no-hover" href="#" onclick="print_page(this)">列印本页</a></li>
        </ul>
        <br/>

        @include('bdata.sugar')

        @include('bdata.statics')

        @include('bdata.hba1c')

        @include('bdata.message')
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
    {!! Html::script('js/timepicker.js') !!}
    {!! Html::script('js/bdata.js') !!}
@stop