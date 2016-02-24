@extends('master')

@section('title')
    行政报表
@stop

@section('activeq1')
    active
@stop

@section('css')
    {!! Html::style('css/quality.css') !!}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">


            <button class="btn btn-success" type="button" onclick="printdiv0()">打印</button>
            <!-- a href="{{-- route('download_excel', array('obj' => $object)) --}}"><button class="btn btn-warning" onclick="return confirm('确定下载?')">汇出Excel</button></a -->
            <a href="{{$url}}" type="button" id="btnExport" onclick="return confirm('确定下载?')"  >汇出Excel</a>
            <!-- a href="#" class="export">汇出</a -->
            <div id="printpage">
                @if($type == 'soap')
                    @include('executive.soap')
                @elseif($type == 'exec')
                    @include('executive.list')
                @endif
                <br>
            </div>
        </div>
    </div>
@stop