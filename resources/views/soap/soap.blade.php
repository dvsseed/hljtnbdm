@extends('master')

@section('title')
    SOAP
@stop

@section('content')
    <div class="container">
        @if(isset($err_msg))
            @include('soap.error')
        @else
            @include('soap.option')
            @include('soap.edit')
        @endif
    </div>
@stop
@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/soap.js') !!}
@stop