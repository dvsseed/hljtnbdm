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
                <h2>行政报表</h2>
                <hr>
                <div class="form-group has-feedback">
                    <div class="form-horizontal">
                        <div id="interval" class="form-group has-feedback">
                            <label for="object" class="control-label col-md-1">对象：</label>
                            <div class="col-md-4">
                                <select class="form-control" id="chart_para">
                                    @foreach($titles as $type => $title)
                                        @foreach($title as $range => $t)
                                            <option value="/executive/{{$range}}/{{$type}}">{{$t}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <button class="btn btn-success" onclick="e = document.getElementById('chart_para'); location.href = e.options[e.selectedIndex].value; ">统计报表</button>
                            </div>
                        </div>
                    </div>
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