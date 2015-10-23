@extends('master')

@section('title')
    人员成绩列表
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3 align="center">人员成绩表</h3>
                <table class="table table-striped" id="sortTable">
                    <thead>
                        <tr>
                            <th class="col-md-2">编号 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>姓名 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>11 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>22 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>33 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>44 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>55 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                            <th>66 <a href="javascript:void(0)"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a></th>
                        </tr>
                    </thead>

                    @foreach ($users as $user)
                        <tr class="myGrade">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->grade->11}}</td>
                            <td>{{$user->grade->22}}</td>
                            <td>{{$user->grade->33}}</td>
                            <td>{{$user->grade->44}}</td>
                            <td>{{$user->grade->55}}</td>
                            <td>{{$user->grade->66}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            @include('Admin.right_bar')

        </div>
    </div>
@stop
