{!! Html::style('css/bdata.css') !!}
{!! Html::style('css/all.css') !!}
<div id="message" class="content" style="display: none">
    <div id="messages" style="height: 550px;overflow: auto;">    Loading.... </div>
    <span class="form-inline" style="position: initial; bottom: 30px; width: 100%">
        {!! Form::open(array('url'=>'post_message','method'=>'POST', 'id'=>'message_form')) !!}
        <textarea id="messagearea" class="form-control" style="height: 100px; width: 80%; margin-left: 10%"></textarea>{!! Form::button('回覆', array('class'=>'btn btn-default', 'id'=>'reply', 'style' => 'margin-left: 20px')) !!}
        {!! Form::close() !!}
    </span>

</div>