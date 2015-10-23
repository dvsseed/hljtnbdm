@extends('layout')

@section('title')
	病患数据
@stop

@section('content')
    <div class="page-header">
        <h3>病患基本数据表</h3>
    </div>

    @include('errors.list')

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-striped">
                <thead>
                    <tr>
                        <th>#</th>
			<th>病历号码</th>
			<th>身份证号</th>
			<!-- th>登入帐号</th -->
			<th>姓名</th>
			<th>生日</th>
			<th>性别</th>
			<th>身高</th>
			<th>体重</th>
			<th>家用电话1</th>
			<th>家用电话2</th>
			<th>行动电话1</th>
			<th>行动电话2</th>
			<th>联络地址</th>
			<th>电子邮件</th>
                        <th class="text-center">功能</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($patientprofiles as $patientprofile)
                <tr>
			<td>{{ $patientprofile->id }}</td>
			<td>{{ $patientprofile->pp_patientid }}</td>
                        <td>{{ $patientprofile->pp_personid }}</td>
			<td>{{ $patientprofile->pp_name }}</td>
			<td>{{ $patientprofile->pp_birthday }}</td>
			<td>{{ $patientprofile->pp_sex ? '男' : '女' }}</td>
			<td>{{ $patientprofile->pp_height }}</td>
			<td>{{ $patientprofile->pp_weight }}</td>
			<td>{{ $patientprofile->pp_tel1 }}</td>
			<td>{{ $patientprofile->pp_tel2 }}</td>
			<td>{{ $patientprofile->pp_mobile1 }}</td>
			<td>{{ $patientprofile->pp_mobile2 }}</td>
			<td>{{ $patientprofile->pp_address }}</td>
			<td>{{ $patientprofile->pp_email }}</td>
			<td>
                        	<a class="btn btn-primary" href="{{ route('patient.show', $patientprofile->id) }}">查</a>
                        	<a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a>
                        	<form action="{{ route('patient.destroy', $patientprofile->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('确定删除?')) { return true } else { return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">删</button></form>
			</td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ route('patient.create') }}">增</a>
        </div>
        {{-- @include('dm.right_bar') --}}
    </div>


@endsection
