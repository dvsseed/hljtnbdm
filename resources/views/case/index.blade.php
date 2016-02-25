@extends('master')

@section('title')
    方案管理
@stop

@section('activec')
active
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3>方案资料表 <span class="badge">{{ $count }}</span></h3>
        </div>
        @include('errors.list')
        <!-- a class="btn btn-success" href="{{-- route('case.create') --}}">增</a -->
        <form method="GET" action="/case" accept-charset="UTF-8" class="form navbar-form navbar-right searchform">
            <select class="form-control" name="category" required>
                <option value="" {{Text::selected($category, '')}}>请选择</option>
                <option value="1" {{Text::selected($category, 1)}}>病患ID</option>
                <option value="2" {{Text::selected($category, 2)}}>病患姓名</option>
                <option value="3" {{Text::selected($category, 3)}}>收案日期</option>
            </select>
            <input class="form-control" placeholder="按栏位搜索..." name="search" type="text" value="{{ $search }}" required>
            <input class="btn btn-default" type="submit" value="搜寻">
        </form>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-condensed table-striped" id="sortcaTable">
                    <thead>
                    <tr>
                        <th>#<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>病患ID<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>病患姓名<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>诊疗阶段</th>
                        <th>收案日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>卫教师</th>
                        <th class="text-center">功能</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($caselists))
                        @foreach($caselists as $caselist)
                            <tr>
                                <td>{{ $caselist->id }}</td>
                                <td>{{ $caselist->cl_patientid }}</td>
                                <td>{{ $caselist->name }}</td>
                                <td>{{ $caselist->cl_case_type==1 ? '初诊' : ($caselist->cl_case_type==2 ? '复诊' : ($caselist->cl_case_type==3 ? '年度检查' : '一般')) }}</td>
                                <td>{{ $caselist->cl_case_date }}</td>
                                <td>{{ \App\User::find($caselist->cl_case_educator)->name }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('case.edit', $caselist->id) }}">改</a>
                                    <form action="{{ route('case.destroy', $caselist->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('确定删除?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" type="submit">删</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1>没有方案资料...</h1>
                    @endif
                    </tbody>
                </table>
                <?php echo $caselists->render(); ?>
            </div>
        </div>
    </div>
@stop

@section('loadScripts')
    {!! Html::script('js/all.js') !!}
    <script>
        $(document).ready(function(){
            $("#sortcaTable").tablesorter();
        });
    </script>
@stop
