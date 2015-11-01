@extends('master')

@section('title')
    SOAP
@stop

@section('content')
    <div class="container">
        @include('soap.option')
        @include('soap.edit')
    </div>
@stop
@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    {!! Html::script('js/soap.js') !!}
@stop