<div class="col-md-2">
    <!-- h3>总人数: {{-- $count --}}</h3 -->
    @foreach ($features as $feature)
    <a href="{{ $feature->href }}"><button class="btn {{ $feature->btnclass }} btn-lg">{{ $feature->innerhtml }}</button></a>
    <br />
    @endforeach
    <!-- a href="/patient"><button class="btn btn-primary btn-lg">病患列表</button></a -->
    <!-- br /-->
    <!-- a href="/patient/create"><button class="btn btn-info btn-lg">添加病患基础信息</button></a -->
    <!-- br / -->
    <!-- a href="{{-- URL::route('download_stu_list_excel') --}}"><button class="btn btn-default btn-lg">下载名单</button></a -->
    <!-- br / -->
    <!-- a href="{{-- URL::route('download_grade_list_excel') --}}"><button class="btn btn-lg btn-default">导出成绩</button></a -->
</div>
