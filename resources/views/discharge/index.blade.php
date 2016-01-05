@extends('master')

@section('title')
    出院指导管理
@stop

@section('activec')
<li class=""><a href="/patient">患者资料</a></li>
<li class=""><a href="/bdata/">血糖</a></li>
<li class=""><a href="/case">方案</a></li>
<li class="active"><a href="/discharge">出院指导</a></li>
@stop

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h3>出院指导表 <span class="badge">{{ $count }}</span></h3>
        </div>
        @include('errors.list')
        <!-- a class="btn btn-success" href="{{-- route('discharge.create') --}}">增</a -->
        <form method="GET" action="/discharge" accept-charset="UTF-8" class="form navbar-form navbar-right searchform">
            <select class="form-control" name="category" required>
                <option value="" {{Text::selected($category, '')}}>请选择</option>
                <option value="1" {{Text::selected($category, 1)}}>出院日期</option>
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
                        <th>医生<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th>出院日期<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        <th class="text-center">功能</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($discharges))
                        @foreach($discharges as $discharge)
                            <tr>
                                <td>{{ $discharge->id }}</td>
                                <td>{{ \App\User::find($discharge->user_id)->pid }}</td>
                                <td>{{ \App\User::find($discharge->user_id)->name }}</td>
                                <td>{{ \App\User::find($discharge->doctor)->name }}</td>
                                <td>{{ $discharge->discharge_at }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('discharge.edit', $discharge->id) }}">改</a>
                                    <form action="{{ route('discharge.destroy', $discharge->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('确定删除?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" type="submit">删</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1>没有出院指导资料...</h1>
                    @endif
                    </tbody>
                </table>
                <?php echo $discharges->render(); ?>
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
