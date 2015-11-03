@extends('master')

@section('title')
    血糖資料
@stop

@section('content')

    <div class="container">
        <h3 align="center">血糖資料</h3>
        <br/>
        <div class="row">
            <div class="col-md-2"><h4>病歷號碼</h4></div>
            <div class="col-md-3"><h4>{{$data['displayname']}}</h4></div>
            <div class="col-md-1"><h4>姓 名</h4></div>
            <div class="col-md-3"><h4>{{$data['patient_displayname']}}</h4></div>
            <div class="col-md-1"><h4>生 日</h4></div>
            <div class="col-md-2"><h4>{{$data['patient_bday']}} , {{$data['patient_age']}}歲</h4></div>
        </div>
        <br/>
        <ul class="nav nav-tabs" id="top">
            <li role="presentation"><a class="menuLink" href="#data">區間資料</a></li>
            <li role="presentation"><a id="batch" class="menuLink" href="#batchInsert">批次輸入</a></li>
            <li role="presentation"><a class="menuLink" href="#statics">統計資料</a></li>
            @if($soap_link != "")
                <li role="presentation"><a class="menuLink real" href="{{$soap_link}}">soap</a></li>
            @endif
            <li role="presentation"><a class="menuLink" href="#hba1c">HbA1C</a></li>
            <li role="presentation"><a class="menuLink" href="#message">留言</a></li>
            <li role="presentation"><a href="#print">列印本頁</a></li>
        </ul>
        <br/>

        @include('bdata.sugar')

        @include('bdata.statics')

        @include('bdata.message')
        <div id="hba1c" class="content" style="display: none">
            <table class="table table-hover">
                <tr>
                    <th></th>
                    <th>時間</th>
                </tr>
            </table>
        </div>
    </div>
    @include('bdata.insert')
    @include('bdata.insertfood')


@stop

@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/timepicker.js') !!}
    {!! Html::script('js/bdata.js') !!}
@stop