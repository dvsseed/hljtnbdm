@extends('master')

@section('title')
    SOAP歷史紀錄
@stop

@section('content')
    {!! Html::style('css/bdata.css') !!}
    <div class="container">
        <h3>病歷號碼: <a href="/soap/{{$uuid}}?new=true">{{$hospital_no_displayname}}</a></h3>
        <br/>
        <table class="table borderless" id="history">
            <tr>
                <td style="width: 150px; min-width: 150px;">衛教日期</td>
                <td style="width: 150px; min-width: 150px;">修改日期</td>
                <td style="min-width: 50px;">S</td>
                <td style="min-width: 50px;">O</td>
                <td style="min-width: 50px;">A</td>
                <td style="min-width: 50px;">P</td>
                <td style="min-width: 50px;">E</td>
                <td style="min-width: 50px;">R</td>
                <td style="width: 60px;min-width: 60px;">衛教師</td>
                <td>刪除</td>
            </tr>
            @foreach($histories as $history)
            <tr>
                <td>{{$history -> created_at}}</td>
                <td>{{$history -> updated_at}}</td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> s_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> o_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> a_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> p_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> e_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> r_text}}</a></td>
                <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> user_id}}</a></td>
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