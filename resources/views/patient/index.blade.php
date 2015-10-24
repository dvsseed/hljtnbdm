@extends('layout')

@section('title')
	患者资料
@stop

@section('content')
    <div class="page-header">
        <h3>患者基本资料表 <span class="badge">{{ $count }}</span></h3>
        @include('patient.his')
    </div>

    @include('errors.list')
    <a class="btn btn-success" href="{{ route('patient.create') }}">增</a>
    <form method="GET" action="/patient" accept-charset="UTF-8" class="form navbar-form navbar-right searchform">
        <select class="form-control" name="category">
          <option value="0" {{ $category==0 ? "selected='selected'" : "" }}>请选择</option>
          <option value="1" {{ $category==1 ? "selected='selected'" : "" }}>姓名</option>
          <option value="2" {{ $category==2 ? "selected='selected'" : "" }}>病历号码</option>
          <option value="3" {{ $category==3 ? "selected='selected'" : "" }}>身份证号</option>
        </select>
        <input required="required" class="form-control" placeholder="按栏位搜索..." name="search" type="text" value="{{ $search }}">
        <input class="btn btn-default" type="submit" value="搜寻">
        <input type="checkbox" value="1" name="forget">清除
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-striped" style="width: 1200px;">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
			<th class="col-md-2">病历号码</th>
			<!-- th class="col-md-3">身份证号</th -->
			<!-- th>登入帐号</th -->
			<th class="col-md-1">姓名</th>
			<th class="col-md-1">生日</th>
			<th class="col-md-1">性别</th>
			<th class="col-md-1">身高</th>
			<th class="col-md-1">体重</th>
			<th class="col-md-2">家用电话</th>
			<!-- th class="col-md-3">家用电话2</th -->
			<th class="col-md-2">行动电话</th>
			<!-- th class="col-md-3">行动电话2</th -->
			<!-- th class="col-md-4">联络地址</th -->
			<!-- th class="col-md-2">电子邮件</th -->
                        <th class="col-md-2 text-center">功能</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($patientprofiles as $patientprofile)
                <tr>
			<td>{{ $patientprofile->id }}</td>
			<td>{{ $patientprofile->pp_patientid }}</td>
                        <!-- td>{{-- $patientprofile->pp_personid --}}</td -->
			<td>{{ $patientprofile->pp_name }}</td>
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
                            <a class="btn btn-primary" href="{{ route('patient.show', $patientprofile->id) }}">查</a><a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a><form action="{{ route('patient.destroy', $patientprofile->id) }}" method="POST" style="display: inline-block;" onsubmit="if(confirm('确定删除?')) { return true } else { return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">删</button></form>
			</td>
                </tr>
                @endforeach

                </tbody>
            </table>

            {{-- <a class="btn btn-success" href="{{ route('patient.create') }}">增</a> --}}
            <?php echo $patientprofiles->render(); ?>
        </div>
        {{-- @include('dm.right_bar') --}}
    </div>

@endsection

@section('scripts')
$(function (){
  $("[data-toggle='popover']").popover();
});
@stop
