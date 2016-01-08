@extends('master')

@section('title')
    建案清单-增
@stop

@section('css')
    <!-- pass through the CSRF (cross-site request forgery) token -->
    <meta name="_token" content="{{ csrf_token() }}" />
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>建案清单 / 增</h3>
                    </div>
                    @include('errors.list')
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'dm_store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form', 'data-toggle' => 'validator')) !!}
                        <div class="form-group">
                            {!! Form::label('id', '#: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('id', old('id'), ['class' => 'form-control', 'readonly', 'placeholder' => '系统自动产生编号']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('doctor_name', '建案人: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('doctor_name', Auth::user()->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('personid', '身份证: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('personid', old('personid'), ['class' => 'form-control', 'pattern' => '^[_A-z0-9]{1,}$', 'maxlength' => '18', 'data-minlength' => '18', 'data-minlength-error' => '输入文字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3">
                                <!-- ajax test buttons -->
                                {!! Form::button('<span class="glyphicon glyphicon-search">搜寻收案数</span>', ['class'=>'btn btn-warning', 'id'=>'get']) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-search">搜寻前次卫教师</span>', ['class'=>'btn btn-warning', 'id'=>'post']) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-search">清空搜寻</span>', ['class'=>'btn btn-warning', 'id'=>'clear']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3 text-danger bg-success">
                                <h5 id="ajaxResponse"></h5>
                                @if($errors->any())
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            {!! Form::label('cardid', '卡号: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('cardid', old('cardid'), ['class' => 'form-control', 'pattern' =>'^[0-9]{1,}$', 'maxlength' => '8', 'data-minlength' => '1', 'data-minlength-error' => '输入数字长度不足', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('duty', '责任卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('duty', $dutys, old('duty'), ['class' => 'form-control', 'required']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('memo', '卫教备注: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::textarea('memo', old('memo'), ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('nurse', '护理卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('nurse', $nurses, old('nurse'), ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('soa_nurse_classes0', '护理卫教项目: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                @foreach($soa_nurse_classes[0] as $soa_nurse_class)
                                    {!! Form::checkbox('soa_nurse_class_pks0[]', $soa_nurse_class->soa_nurse_class_pk, old('soa_nurse_class_pks0'), ['class' => 'field']) !!}{{$soa_nurse_class->name}}<br>
                                @endforeach
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('dietitian', '营养卫教: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('dietitian', $dietitians, old('dietitian'), ['class' => 'form-control']) !!}
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::label('soa_nurse_classes1', '营养卫教项目: ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                @foreach($soa_nurse_classes[1] as $soa_nurse_class)
                                    {!! Form::checkbox('soa_nurse_class_pks1[]', $soa_nurse_class->soa_nurse_class_pk, old('soa_nurse_class_pks1'), ['class' => 'field']) !!}{{$soa_nurse_class->name}}<br>
                                @endforeach
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="group">
                            <a class="btn btn-default" href="{{ route('dm_home') }}">返回</a>
                            {!! Form::submit('确认修改', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    $(function(){
        // set up jQuery with the CSRF token, or else post routes will fail
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        // handlers
        function onGetClick(event){
            // it's not passing any data with the get route, though you can if you want
            // $.get('/dm/ajaxget', onSuccess);
            var url = 'ajaxget';
            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: "json",
                success: function(data) {
                    $('#ajaxResponse').empty();
                    $("#ajaxResponse").html("<div>"+data.msg+"</div>");
                },
                error: function() {
                    alert('Opps error occured.');
                }
            });
        }
        function onPostClick(event){
            // it's passing data with the post route, as this is more normal
            // $.post('/dm/ajaxpost', {payload:'test'}, onSuccess);
            // var formData = $(this).serialize();
            var personid = $('input[name=personid]').val();
            var url = 'ajaxpost';
            $.ajax({
                type: "POST",
                url: url,
                data: {personid: personid},
                dataType: "json",
                success: function(data) {
                    //alert(data);
                    //console.log(data);
                    $('#ajaxResponse').empty();
                    $("#ajaxResponse").html("<div>"+data.msg+"</div>");
                },
                error: function() {
                    alert('Opps error occured.');
                }
            });
        }
        function onClearClick(event){
            $('#ajaxResponse').empty();
        }
        function onSuccess(data, status, xhr){
            // with our success handler, we're just logging the data...
            console.log(data, status, xhr);
            // but you can do something with it if you like - the JSON is deserialised into an object
            console.log(String(data.value).toUpperCase());
        }
        // listeners
        $('button#get').on('click', onGetClick);
        $('button#post').on('click', onPostClick);
        $('button#clear').on('click', onClearClick);
    });
@stop
