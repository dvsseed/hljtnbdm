@extends('master')

@section('title')
    血糖資料
@stop

@section('content')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/bdata.js') !!}
    <div class="container">
        <h3 align="center">血糖資料</h3>
        <br/>
        <div class="row">
            <div class="col-md-2"><h4>病歷號碼</h4></div>
            <div class="col-md-2"><h4>{{$data['displayname']}}</h4></div>
            <div class="col-md-2"><h4>姓 名</h4></div>
            <div class="col-md-2"><h4>{{$data['patient_displayname']}}</h4></div>
            <div class="col-md-2"><h4>生 日</h4></div>
            <div class="col-md-2"><h4>西元2000年1月1日 , 16歲</h4></div>
        </div>
        <br/>
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a class="menuLink" href="#data">區間資料</a></li>
            <li role="presentation"><a class="menuLink" href="#statics">統計資料</a></li>
            <li role="presentation"><a class="menuLink" href="#hba1c">HbA1C</a></li>
            <li role="presentation"><a href="#print">列印本頁</a></li>
        </ul>
        <br/>

        @include('bdata.sugar')

        @include('bdata.statics')
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