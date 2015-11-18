@extends('master')

@section('title')
    SOAP
@stop

@section('content')
    <div class="container">
        @if(isset($err_msg))
            @include('soap.error')
        @else
            <table>
                <tr>
                    <td>@include('soap.option')</td>
                    <td>@include('soap.edit')</td>
                </tr>
            </table>
        @endif
        <input id="history_pk" type="hidden" value="{{$history_pk}}"/>
    </div>
@stop
@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/soap.js') !!}
@stop