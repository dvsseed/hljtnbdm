@extends('master')

@section('title')
    SOAP
@stop

@section('content')
    {!! Html::style('css/all.css') !!}
    <div class="container-fluid">
        @if(isset($err_msg))
            @include('soap.error')
        @else
            <table class="table">
                <tr>
                    <td colspan="2">
                        <table class="table borderless" id="main_class">
                            <tr>
                                <td colspan="3" class="form-inline" style="text-align: left">
                                    <a class="btn btn-success" href="/soap/{{$uuid}}?new=true" style="margin-right: 15px">增</a>
                                    卫教日期
                                    <input id="health_date" type="date" class="form-control" style="margin-left: 15px" value="{{date("Y-m-d")}}"/>
                                </td>
                            </tr>
                            <tr>
                                @foreach($main_classes as $main_class)
                                    @if($main_class -> main_class_pk == 1)
                                        <td width="{{100/count($main_classes)}}%"><button class="form-control btn-primary" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
                                    @else
                                        <td width="{{100/count($main_classes)}}%"><button class="form-control" data="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</button></td>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="min-width: 600px">@include('soap.edit')</td>
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
    {!! Html::script('js/modernizr.min.js') !!}
@stop