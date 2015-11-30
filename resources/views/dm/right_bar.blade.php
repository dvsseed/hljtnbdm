<div class="col-md-1">
    <!-- h3>总人数: {{-- $count --}}</h3 -->
    <!-- a href="/dm/personal"><button class="btn btn-success btn-lg">个人信息</button></a -->
    <!-- br / -->
    @foreach ($features as $feature)
        @if($feature->id == 1 && ($doctor || $users->position == '护理师' || $users->position == '营养师'))
            <a href="{{ $feature->href }}"><button class="btn {{ $feature->btnclass }} btn-lg">{{ $feature->innerhtml }}</button></a>
        @else
            <a href="{{ $feature->href }}"><button class="btn {{ $feature->btnclass }} btn-lg">{{ $feature->innerhtml }}</button></a>
        @endif
        <br />
    @endforeach
    <!-- a href="/patient/create"><button class="btn btn-info btn-lg">添加病患基础信息</button></a -->
    <!-- br / -->
    <!-- a href="{{-- URL::route('download_stu_list_excel') --}}"><button class="btn btn-default btn-lg">下载名单</button></a -->
    <!-- br / -->
    <!-- a href="{{-- URL::route('download_grade_list_excel') --}}"><button class="btn btn-lg btn-default">导出成绩</button></a -->
</div>
