<div class="col-md-2">
    <h3>总{{ $countstr }}数: <span class="badge">{{ $count }}</span></h3>
    <a href="/admin"><button class="btn btn-success btn-lg">人员列表</button></a>
    <br />
    <a href="/feature"><button class="btn btn-primary btn-lg">功能管理</button></a>
    <br />
    <a href="/hasfeature"><button class="btn btn-info btn-lg">操作管理</button></a>
    <br />
    <a href="/event"><button class="btn btn-danger btn-lg">轨迹纪录</button></a>
    <br />
    <a href="{{ URL::route('download_dm_list_excel') }}"><button class="btn btn-warning btn-lg">下载名单</button></a>
</div>
