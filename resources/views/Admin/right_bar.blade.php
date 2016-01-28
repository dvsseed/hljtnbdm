<div class="col-sm-1">
    <a href="/admin"><button class="btn btn-success btn-lg">人员列表</button></a>
    <br />
    <!-- a href="/feature"><button class="btn btn-primary btn-lg">功能管理</button></a -->
    <!-- br / -->
    <!-- a href="/hasfeature"><button class="btn btn-info btn-lg">操作管理</button></a -->
    <!-- br / -->
    <a href="/event"><button class="btn btn-danger btn-lg">轨迹纪录</button></a>
    <br />
    <a href="{{ URL::route('download_users_list_excel') }}"><button class="btn btn-warning btn-lg" onclick="return confirm('确定下载?')">下载名单</button></a>
    <br />
    <a href="/upload"><button class="btn btn-default btn-lg">文档上传</button></a>
</div>
