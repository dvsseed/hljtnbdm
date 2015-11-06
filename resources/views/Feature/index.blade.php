@extends('master')

@section('title')
    管理员
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                @include('errors.list')

                <h3 align="center">功能信息表</h3>
                <a href="/feature/create"><button class="btn btn-primary">添加功能</button></a>
                <table class="table table-striped table-hover">
                    <tr style="background: silver;">
                        <th>#</th>
                        <th>方法名</th>
                        <th>按钮类</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    @if (count($features))
                        @foreach ($features as $feature)
                            <tr>
                                <td>{{ $feature->id }}</td>
                                <td>{{ $feature->href }}</td>
                                <td>{{ $feature->btnclass }}</td>
                                <td>{{ $feature->innerhtml }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$feature->id}}">更新</button>
                                    <!-- form action="{{ url('feature/'.$feature->id) }}" style='display: inline' method="post" -->
                                        <!-- input type="hidden" name="_method" value="DELETE" -->
                                        <!-- input type="hidden" name="_token" value="{{-- csrf_token() --}}" -->
                                        <!-- button class="btn btn-sm btn-danger" onclick="return confirm('确定删除?')">删除</button -->
                                    <!-- /form -->
                                </td>
                            </tr>

                            @include('Feature.upload_feature')

                        @endforeach
                    @else
                        <h1>没有功能,请管理员添加</h1>
                    @endif
                </table>
                <?php echo $features->render(); ?>
            </div>
            @include('Admin.right_bar')
        </div>

    </div>
@stop
