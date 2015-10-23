<div class="modal fade" id="myModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5 class="modal-title" id="myModalLabel">{{-- $user->name --}}更新</h5>
            </div>
            {!! Form::model($user, ['url' => '/admin/upload_user', 'class' => 'form-horizontal']) !!}

              <div class="modal-body">

                {!! Form::hidden('user_id', $user->id) !!}
                <h6>
                  {!! Form::label('id', '编号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('id', null, ['class' => 'form-control', 'readonly']) !!}
                </h6>
                <h6>
                  {!! Form::label('name', '姓名: ', ['class' => 'control-label']) !!}
                  {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('password', '密码: ', ['class' => 'control-label']) !!}
                  <br />
                  {!! Form::password('password', '', ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('departmentno', '部门编号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('departmentno', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('department', '部门名称: ', ['class' => 'control-label']) !!}
                  {!! Form::text('department', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('positionno', '职务代码: ', ['class' => 'control-label']) !!}
                  {!! Form::text('positionno', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('position', '职务: ', ['class' => 'control-label']) !!}
                  {!! Form::text('position', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('phone', '手机号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('phone', null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('email', '邮箱: ', ['class' => 'control-label']) !!}
                  {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                </h6>

              </div>

              <div class="modal-footer">
                {!! Form::button('关闭', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                {!! Form::submit('提交', ['class' => 'btn btn-success']) !!}
              </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
