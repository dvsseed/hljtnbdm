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
                    <td colspan="2">
                        <table class="table borderless" id="main_class">
                            <tr>
                                <td style="text-align: left">
                                    <a class="btn btn-success" href="/soap/{{$uuid}}?new=true">增</a>
                                </td>
                            </tr>
                            <tr>
                                @foreach($main_classes as $main_class)
                                    @if($main_class -> main_class_pk == 1)
                                        <td><button class="form-control btn-primary" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
                                    @else
                                        <td><button class="form-control" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>@include('soap.edit')</td>
                    <td style="vertical-align: top;">@include('soap.option')</td>
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