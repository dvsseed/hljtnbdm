@extends('master')

@section('title')
    管理员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                @include('errors.list')
                <h3 align="center">人员信息表</h3>
                <a href="/admin/create"><button class="btn btn-primary">添加人员</button></a>
                {!! Form::open(array('route'=>'admin.index', 'method'=>'get', 'class'=>'form navbar-form navbar-right searchform')) !!}
                    {!! Form::select('category', $categories, $category, ['required', 'class' => 'form-control']) !!}
                    {!! Form::text('search', $search, array('required', 'class'=>'form-control', 'placeholder'=>'按栏位搜索...')) !!}
                    {!! Form::submit('搜寻', array('class'=>'btn btn-default')) !!}
                    <!-- a class="btn btn-info" href="{{-- route('admin.forget', 1) --}}">清除</a -->
                {!! Form::close() !!}
                <table class="table table-striped table-hover">
                    <tr style="background: silver;">
                        <th>#</th>
                        <th>帐号</th>
                        <th>姓名</th>
                        <th>医院</th>
                        <th>部门</th>
                        <th>手机</th>
                        <th>邮箱</th>
                        <th class="text-center">操作</th>
                    </tr>
                    @if (count($users))
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->account }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->hospital == "hljtnb" ? "黑龙江" : "" }}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$user->id}}">更新</button>
                                    <form action="{{ url('admin/'.$user->id) }}" style='display: inline' method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('确定删除?')">删除</button>
                                    </form>
                                </td>
                            </tr>
                            @include('Admin.upload_user')
                        @endforeach
                    @else
                        <h1>没有人员名单,请管理员添加...</h1>
                    @endif
                </table>
                <?php echo $users->render(); ?>
            </div>
            @include('Admin.right_bar')
        </div>
    </div>
@stop
