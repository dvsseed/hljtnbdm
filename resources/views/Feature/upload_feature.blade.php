<div class="modal fade" id="myModal{{ $feature->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5 class="modal-title" id="myModalLabel">{{-- $feature->name --}}更新</h5>
            </div>
            {!! Form::model($feature, ['url' => '/feature/upload_feature', 'class' => 'form-horizontal']) !!}

              <div class="modal-body">

                {!! Form::hidden('feature_id', $feature->id) !!}
                <h6>
                  {!! Form::label('id', '编号: ', ['class' => 'control-label']) !!}
                  {!! Form::text('id', null, ['class' => 'form-control', 'readonly']) !!}
                </h6>
                <h6>
                  {!! Form::label('href', '方法名: ', ['class' => 'control-label']) !!}
                  {!! Form::text('href', null, ['class' => 'form-control', 'required']) !!}
                </h6>
{{--
                <h6>
                  {!! Form::label('btnclass', '按钮类: ', ['class' => 'control-label']) !!}
                  {!! Form::text('btnclass', null, ['class' => 'form-control', 'required']) !!}
                </h6>
--}}
                <h6>
                  {!! Form::label('btnclass', '按钮类: ', ['class' => 'control-label']) !!}
                  {!! Form::select('btnclass', ['btn-default' => 'btn-default', 'btn-primary' => 'btn-primary', 'btn-success' => 'btn-success', 'btn-info' => 'btn-info', 'btn-warning' => 'btn-warning', 'btn-danger' => 'btn-danger'], null, ['class' => 'form-control', 'required']) !!}
                </h6>
                <h6>
                  {!! Form::label('innerhtml', '描述: ', ['class' => 'control-label']) !!}
                  {!! Form::text('innerhtml', null, ['class' => 'form-control', 'required']) !!}
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
