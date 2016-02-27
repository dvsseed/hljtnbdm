@extends('master')

@section('title')
    行政报表
@stop

@section('activeq2')
    active
@stop

@section('css')
    {!! Html::style('css/quality.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <a class="btn btn-default" href="#" onclick="history.go(-1);">返回</a>
                <button class="btn btn-success" type="button" onclick="printdiv0()">打印</button>
                <a href="{{$url}}"  class="btn btn-warning" id="btnExport" onclick="return confirm('确定下载?')"  >汇出Excel</a>
                <div id="printpage">
                    @if($type == 'soap')
                        @if(isset($personal))
                            @include('executive.personsoap')
                        @else
                            @include('executive.soap')
                        @endif

                    @elseif($type == 'exec')
                        @if(isset($personal))
                            @include('executive.person')
                        @else
                            @include('executive.list')
                        @endif
                    @endif
                    <br>
                </div>
            </div>
        </div>
    </div>
@stop
@section('loadScripts')
    {!! Html::script('js/quality.js') !!}
    <script>
        //        $(document).ready(function(){
        //            $("#btnExport").click(function(e){
        //                window.open('data:application/vnd.ms-excel,' + $('#printpage').html());
        //                e.preventDefault();
        //            });
        //        });
    </script>
@stop