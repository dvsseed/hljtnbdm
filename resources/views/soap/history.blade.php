@extends('master')

@section('title')
    SOAP历史纪录
@stop

@section('content')
    {!! Html::style('css/bdata.css') !!}
    <div class="container">
        <h3>病历号码: <a href="/soap/{{$uuid}}?new=true">{{$hospital_no_displayname}}</a></h3>
        <br/>
        <table class="table" id="history">
            <tr>
                <td style="width: 150px; min-width: 150px;">卫教日期</td>
                <td style="width: 150px; min-width: 150px;">修改日期</td>
                <td style="min-width: 50px;">S</td>
                <td style="min-width: 50px;">O</td>
                <td style="min-width: 50px;">A</td>
                <td style="min-width: 50px;">P</td>
                <td style="min-width: 50px;">E</td>
                <td style="min-width: 50px;">R</td>
                <td style="width: 60px;min-width: 60px;">卫教师</td>
                <td>删除</td>
            </tr>
            @foreach($histories as $history)
                <tr >
                    <td>{{$history -> created_at}}</td>
                    <td>{{$history -> updated_at}}</td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> s_text)!!}</a></td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> o_text)!!}</a></td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> a_text)!!}</a></td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> p_text)!!}</a></td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> e_text)!!}</a></td>
                    <td style="text-align: left"><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{!! nl2br($history -> r_text)!!}</a></td>
                    <td><a href= "/soap/{{$uuid}}?history={{$history -> user_soap_history_pk}}" >{{$history -> user_id}}</a></td>
                    <td><button class="btn btn-default" onclick="delete_soap({{$history -> user_soap_history_pk}})">删除</button></td>
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