@extends('master')

@section('title')
    管理员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                @include('errors.list')

                <h3 align="center">操作信息表</h3>
                <a href="/hasfeature/create"><button class="btn btn-primary">添加操作</button></a>
                <table class="table table-striped table-hover">
                    <tr style="background: silver;">
                        <th>#</th>
                        <!-- th>人员#</th -->
                        <th>姓名</th>
                        <!-- th>功能#</th -->
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    @if (count($hasfeatures))
                        @foreach ($hasfeatures as $hasfeature)
                            <tr>
                                <td>{{ $hasfeature->id }}</td>
                                <!-- td>{{-- $hasfeature->user_id --}}</td -->
                                <td>{{ $hasfeature->name }}</td>
                                <!-- td>{{ $hasfeature->feature_id --}}</td -->
                                <td>{{ $hasfeature->innerhtml }}</td>
                                <td>
                                    {{-- <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$hasfeature->id}}">更新</button> --}}
                                    <form action="{{ url('hasfeature/'.$hasfeature->id) }}" style='display: inline' method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('确定删除?')">删除</button>
                                    </form>
                                </td>
                            </tr>
                            {{-- @include('Hasfeature.upload_hasfeature') --}}
                        @endforeach
                    @else
                        <h1>没有操作,请管理员添加</h1>
                    @endif
                </table>
                <?php echo $hasfeatures->render(); ?>
            </div>
            @include('Admin.right_bar')
        </div>

    </div>
@stop
