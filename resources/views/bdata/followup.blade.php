@extends('master')

@section('title')
    随访清单
@stop

@section('activec')
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3>随访清单 <span class="badge">{{ $count }}</span></h3>
        </div>
        @include('errors.list')
    <!--
        <form method="GET" action="/discharge" accept-charset="UTF-8" class="form navbar-form navbar-right searchform">
            <select class="form-control" name="category" required>
                <option value="" {{-- Text::selected($category, '') --}}>请选择</option>
                <option value="1" {{-- Text::selected($category, 1) --}}>出院日期</option>
                <option value="2" {{-- Text::selected($category, 2) --}}>住院医生</option>
            </select>
            <input class="form-control" placeholder="按栏位搜索..." name="search" type="text" value="{{-- $search --}}" required>
            <input class="btn btn-default" type="submit" value="搜寻">
        </form>
        -->

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-condensed table-striped" id="sortflTable">
                    <thead>
                    <tr>
                        <th>身份证</th>
                        <th>卡号</th>
                        <th>姓名</th>
                        <th>血糖更新日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>预定追踪日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>起始日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>结束日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>追踪方式</th>
                        <th>联络时段</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($lists))
                        @foreach($lists as $list)
                            <tr>
                                <td>{{ $list->personid }}</td>
                                <td>{{ $list->cardid }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->calendar_date }}</td>
                                <td>{{ $list->trace_time }}</td>
                                <td>{{ $list->start_date }}</td>
                                <td>{{ $list->med_date }}</td>
                                <td>{{ $list->trace_method }}</td>
                                <td>{{ $list->contact_time }}</td>
                            </tr>
                        @endforeach
                    @else
                        <h1>没有随访资料...</h1>
                    @endif
                    </tbody>
                </table>
                <?php echo $lists->render(); ?>
            </div>
        </div>
    </div>
@stop

@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    <script>
        $(document).ready(function(){
            $("#sortflTable").tablesorter();
        });
    </script>
@stop
