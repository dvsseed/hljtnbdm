@extends('master')

@section('title')
    管理员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                @include('errors.list')

                <h3 align="center">轨迹纪录表</h3>
                <!-- a href="/event/create"><button class="btn btn-primary">添加操作</button></a -->
                <table class="table table-hover">
                    <tr>
                        <th>编号</th>
                        <th>数据表</th>
                        <th>行为</th>
                        <th>人员编号</th>
                        <th>姓名</th>
                        <th>异动时间</th>
                    </tr>
                    @if (count($events))
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->tablename }}</td>
                                <td>{{ $event->action }}</td>
                                <td>{{ $event->user_id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->updated_at }}</td>
                                <!-- td -->
                                    {{-- <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$event->id}}">更新</button> --}}
                                    <!-- form action="{{-- url('event/'.$event->id) --}}" style='display: inline' method="post" -->
                                        <!-- input type="hidden" name="_method" value="DELETE" -->
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <!-- button class="btn btn-sm btn-danger" onclick="return confirm('确定删除?')">删除</button -->
                                    <!-- /form -->
                                <!-- /td -->
                            </tr>

                            {{-- @include('event.upload_event') --}}

                        @endforeach
                    @else
                        <h1>没有纪录...</h1>
                    @endif
                </table>
                <?php echo $events->render(); ?>
            </div>
            @include('Admin.right_bar')
        </div>

    </div>
@stop
