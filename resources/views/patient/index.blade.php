@extends('layout')

@section('title')
    患者资料
@stop

@section('activep')
active
@stop

@section('navabout')
    /aboutpatient
@stop

@section('content')
    <div class="page-header">
        <h3>患者基本资料表 <span class="badge">{{ $count }}</span></h3>
        {{-- @include('patient.his') --}}
    </div>

    @include('errors.list')
    <a class="btn btn-success" href="{{ route('patient.create') }}">增</a>
    <form method="GET" action="/patient" accept-charset="UTF-8" class="form navbar-form navbar-right searchform">
        <select class="form-control" name="category" required>
            <option value="" {{Text::selected($category, '')}}>请选择</option>
            <option value="1" {{Text::selected($category, 1)}}>病历号码</option>
            <option value="2" {{Text::selected($category, 2)}}>姓名</option>
            <option value="3" {{Text::selected($category, 3)}}>生日</option>
            <option value="4" {{Text::selected($category, 4)}}>家用电话</option>
            <option value="5" {{Text::selected($category, 5)}}>行动电话</option>
        </select>
        <input class="form-control" placeholder="按栏位搜索..." name="search" type="text"
               value="{{ $search }}" required>
        <input class="btn btn-default" type="submit" value="搜寻">
        <!-- a class="btn btn-info" href="{{-- route('patient.forget', 1) --}}">清除</a -->
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-striped" id="sortppTable">
                <thead>
                <tr>
                    <th>#<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                    <th>病历号码<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                    <!-- th class="col-md-3">身份证号</th -->
                    <!-- th>帐号</th -->
                    <th>姓名<a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                    <th>生日</th>
                    <th>性别</th>
                    <th>身高</th>
                    <th>体重</th>
                    <th>家用电话</th>
                    <!-- th class="col-md-3">家用电话2</th -->
                    <th>行动电话</th>
                    <!-- th class="col-md-3">行动电话2</th -->
                    <!-- th class="col-md-4">联络地址</th -->
                    <!-- th class="col-md-2">电子邮件</th -->
                    <th class="text-center">功能</th>
                </tr>
                </thead>

                <tbody>
                @if (count($patientprofiles))
                    @foreach($patientprofiles as $patientprofile)
                        <tr>
                            <td>{{ $patientprofile->id }}</td>
                            {{-- @if($patientprofile->hospital_no != null ) --}}
                                    <!-- td><a href="/bdata/{{-- $patientprofile->hospital_no-> hospital_no_uuid --}}">{{-- $patientprofile->pp_patientid --}}</a></td -->
                            @if($patientprofile->hospital_no_uuid != null)
                                <td><a href="/bdata/{{ $patientprofile->hospital_no_uuid }}">{{ $patientprofile->pp_patientid }}</a></td>
                            @else
                                <td>{{ $patientprofile->pp_patientid}}</td>
                            @endif
                            <td>{{ $patientprofile->name }}</td>
                            <td>{{ $patientprofile->pp_birthday }}</td>
                            <td>{{ $patientprofile->pp_sex ? '男' : '女' }}</td>
                            <td>{{ $patientprofile->pp_height }}</td>
                            <td>{{ $patientprofile->pp_weight }}</td>
                            <td>{{ $patientprofile->pp_tel1 }}</td>
                            <!-- td>{{-- $patientprofile->pp_tel2 --}}</td -->
                            <td>{{ $patientprofile->pp_mobile1 }}</td>
                            <!-- td>{{-- $patientprofile->pp_mobile2 --}}</td -->
                            <!-- td>{{ $patientprofile->pp_address }}</td -->
                            <!-- td>{{ $patientprofile->pp_email }}</td -->
                            <td>
                                <a class="btn btn-primary" href="{{ route('patient.show', $patientprofile->id) }}">查</a>
                                <a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a>
                                <form action="{{ route('patient.destroy', $patientprofile->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('确定删除?')">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-danger" type="submit">删</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h1>没有患者资料...</h1>
                @endif
                </tbody>
            </table>
            <?php echo $patientprofiles->render(); ?>
        </div>
        {{-- @include('dm.right_bar') --}}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#sortppTable").tablesorter();
        });
    </script>
@stop