<div class="col-md-1">
    <a href="/admin"><button class="btn btn-success btn-lg">人员列表</button></a>
    <br />
    <a href="/feature"><button class="btn btn-primary btn-lg">功能管理</button></a>
    <br />
    <a href="/hasfeature"><button class="btn btn-info btn-lg">操作管理</button></a>
    <!-- br / -->
    <a href="{{ URL::route('download_dm_list_excel') }}"><button class="btn btn-default btn-lg">下载名单</button></a>
    <!-- br / -->
    <!-- a href="{{-- URL::route('download_grade_list_excel') --}}"><button class="btn btn-lg btn-default">导出成绩</button></a -->
</div>
