<div id="myModal{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            {!! Form::model($user, ['url' => '/admin/upload_user', 'class' => 'form-horizontal', 'role' => 'form']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title" id="myModalLabel">{{-- $user->name --}}更新</h6>
            </div>

            <div class="modal-body" style="font-size:11px;">
                {!! Form::hidden('user_id', $user->id) !!}
                  {!! Form::label('id', '#: ', ['class' => 'control-label']) !!}
                  {!! Form::text('id', null, ['class' => 'form-control', 'readonly', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('account', '帐号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('account', null, ['class' => 'form-control', 'readonly', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('name', '姓名: ', ['class' => 'control-label']) !!}
                  {!! Form::text('name', null, ['class' => 'form-control', 'required', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('password', '密码: ', ['class' => 'control-label']) !!}
                  {!! Form::text('password', '', ['class' => 'form-control', 'required', 'placeholder' => '请输入密码', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('departmentno', '部门编号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('departmentno', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('department', '部门名称: ', ['class' => 'control-label']) !!}
                  {!! Form::text('department', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('positionno', '职务代码: ', ['class' => 'control-label']) !!}
                  {!! Form::text('positionno', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('position', '职务: ', ['class' => 'control-label']) !!}
                  {!! Form::text('position', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('phone', '手机号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('phone', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
                  {!! Form::label('email', '邮箱: ', ['class' => 'control-label']) !!}
                  {!! Form::email('email', null, ['class' => 'form-control', 'style' => 'font-size:11px']) !!}
            </div>

            <div class="modal-footer">
                {!! Form::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => 'modal', 'style' => 'font-size:11px']) !!}
                {!! Form::submit('提交', ['class' => 'btn btn-success', 'style' => 'font-size:11px']) !!}
            </div>
           {!! Form::close() !!}
        </div>
    </div>
</div>
