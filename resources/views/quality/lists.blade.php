@extends('master')

@section('title')
    统计报表
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
        @if($object == 0 || $object == 1 || $object == 2 || $object == 3)
            <div class="col-md-6">
        @elseif($object == 4 || $object == 6)
            <div class="col-md-8">
        @elseif($object == 5)
            <div class="col-md-11">
        @endif
            @include('errors.list')
            <a class="btn btn-default" href="{{ route('quality.index') }}">返回</a>
            <button class="btn btn-success" type="button" onclick="printdiv0()">打印</button>
            <!-- a href="{{-- route('download_excel', array('obj' => $object)) --}}"><button class="btn btn-warning" onclick="return confirm('确定下载?')">汇出Excel</button></a -->
            <input type="button" id="btnExport" onclick="return confirm('确定下载?')" value="汇出Excel" />
            <!-- a href="#" class="export">汇出</a -->
            <div id="printpage">
            <table>
                <tr>
                    @if($object == 0 || $object == 1 || $object == 2 || $object == 3)
                        <th colspan="4">{{ $header }}</th>
                    @elseif($object == 4)
                        <th colspan="15">{{ $header }}</th>
                    @elseif($object == 5)
                        <th colspan="20">{{ $header }}</th>
                    @elseif($object == 6)
                        <th colspan="16">{{ $header }}</th>
                    @endif
                </tr>
                <tr>
                    @if($object == 0 || $object == 1 || $object == 2 || $object == 3)
                        <th>指标项目</th>
                        <th>切点</th>
                        <th>笔数</th>
                        <th>百分比</th>
                    @elseif($object == 4)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>BMI</th>
                        <th>腰围</th>
                        <th>吸烟</th>
                        <th>饮酒</th>
                        <th>牙周病</th>
                        <th>咀嚼</th>
                    @elseif($object == 5)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>肾病变</th>
                        <th>周边血管病变</th>
                        <th>神经病变</th>
                        <th>视网膜病变</th>
                        <th>白内障</th>
                        <th>冠心病</th>
                        <th>脑中风</th>
                        <th>失明</th>
                        <th>洗肾</th>
                        <th>下肢截肢</th>
                        <th>高低血糖就医</th>
                    @elseif($object == 6)
                        <th>ID</th>
                        <th>姓名</th>
                        <th>生日</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>罹病年</th>
                        <th>教育程度</th>
                        <th>身高</th>
                        <th>体重</th>
                        <th>BMI</th>
                        <th>A1C</th>
                        <th>LDL</th>
                        <th>TG</th>
                        <th>eGFR</th>
                        <th>BP</th>
                        <th>BP</th>
                    @endif
                </tr>
                @if($object == 0)
                    @include('quality.list0')
                @elseif($object == 1)
                    @include('quality.list1')
                @elseif($object == 2)
                    @include('quality.list2')
                @elseif($object == 3)
                    @include('quality.list3')
                @elseif($object == 4)
                    @include('quality.list4')
                @elseif($object == 5)
                    @include('quality.list5')
                @elseif($object == 6)
                    @include('quality.list6')
                @elseif($object == 7)
                    @include('quality.list7')
                @elseif($object == 8)
                    @include('quality.list8')
                @elseif($object == 9)
                    @include('quality.list9')
                @elseif($object == 10)
                    @include('quality.list10')
                @elseif($object == 11)
                    @include('quality.list11')
                @elseif($object == 12)
                    @include('quality.list12')
                @elseif($object == 13)
                    @include('quality.list13')
                @elseif($object == 14)
                    @include('quality.list14')
                @elseif($object == 15)
                    @include('quality.list15')
                @elseif($object == 16)
                    @include('quality.list16')
                @elseif($object == 17)
                    @include('quality.list17')
                @elseif($object == 18)
                    @include('quality.list18')
                @elseif($object == 19)
                    @include('quality.list19')
                @elseif($object == 20)
                    @include('quality.list20')
                @else
                    <h1>没有资料...</h1>
                @endif
            </table>
            <br>
            </div>
        </div>
    </div>
</div>
@stop

@section('loadScripts')
    {!! Html::script('js/quality.js') !!}
    <script>
        $(document).ready(function(){
            $("#btnExport").click(function(e){
                window.open('data:application/vnd.ms-excel,' + $('#printpage').html());
                e.preventDefault();
            });

/*
            function exportTableToCSV($table, filename) {
                var $rows = $table.find('tr:has(td)'),
                // Temporary delimiter characters unlikely to be typed by keyboard
                // This is to avoid accidentally splitting the actual contents
                tmpColDelim = String.fromCharCode(11), // vertical tab character
                tmpRowDelim = String.fromCharCode(0), // null character
                // actual delimiter characters for CSV format
                colDelim = '","',
                rowDelim = '"\r\n"',
                // Grab text from table into CSV formatted string
                csv = '"' + $rows.map(function (i, row) {
                            var $row = $(row),
                                    $cols = $row.find('td');
                            return $cols.map(function (j, col) {
                                var $col = $(col),
                                        text = $col.text();
                                return text.replace(/"/g, '""'); // escape double quotes
                            }).get().join(tmpColDelim);
                        }).get().join(tmpRowDelim)
                                .split(tmpRowDelim).join(rowDelim)
                                .split(tmpColDelim).join(colDelim) + '"',
                // Data URI
                csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                $(this)
                    .attr({
                        'download': filename,
                        'href': csvData,
                        'target': '_blank'
                    });
            }

            // This must be a hyperlink
            $(".export").on('click', function(event) {
                if(confirm('确定下载?')) {
                    // CSV
                    exportTableToCSV.apply(this, [$('#printpage>table'), 'export.csv']);
                }
                // IF CSV, don't do event.preventDefault() or return false
                // We actually need this to be a typical hyperlink
            });
*/

        });
    </script>
@stop
