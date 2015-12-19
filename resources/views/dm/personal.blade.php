@extends('master')

@section('title')
    欢迎 -- {{ Auth::user()->name }}
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/dm/personal"><button class="btn btn-info">个人信息</button></a>
                </div>

                <div class="panel-body">
                    <div class="personal-mes">
                        #: {{ Auth::user()->id }}
                        <br />
                        帐号: {{ Auth::user()->account }}
                        <br />
                        姓名: {{ Auth::user()->name }}
                        <br />
                        部门: {{ Auth::user()->department }}
                        <br />
                        职务: {{ Auth::user()->position }}
                        <br />
                        手机: {{ Auth::user()->phone }}
                        <br />
                        邮箱: {{ Auth::user()->email }}
                        <hr />
                        <a href="/dm/edit"><button class="btn btn-primary">修改资料</button></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('dm.right_bar') --}}
    </div>
</div>
@stop
