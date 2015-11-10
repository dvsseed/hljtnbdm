@extends('master')

@section('title')
    SOAP歷史紀錄
@stop

@section('content')
    {!! Html::style('css/bdata.css') !!}
    <div class="container">
        <h3>病歷號碼: <a href="/soap/{{$uuid}}">{{$hospital_no_displayname}}</a></h3>
        <br/>
        <table class="table borderless" id="history">
            <tr>
                <td>衛教日期</td>
                <td>S</td>
                <td>O</td>
                <td>A</td>
                <td>P</td>
                <td>E</td>
                <td>R</td>
                <td>刪除</td>
            </tr>
            @foreach($histories as $history)
            <tr>
                <td>{{$history -> creatred_at}}</td>
                <td>{{$history -> s_text}}</td>
                <td>{{$history -> o_text}}</td>
                <td>{{$history -> a_text}}</td>
                <td>{{$history -> p_text}}</td>
                <td>{{$history -> e_text}}</td>
                <td>{{$history -> r_text}}</td>
                <td><button class="btn btn-default" onclick="delete_soap({{$history -> user_soap_history_pk}})">刪除</button></td>
            </tr>
            @endforeach
        </table>
    </div>

    {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'soap_save')) !!}
    {!! Form::close() !!}
@stop
@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/soap.js') !!}
@stop