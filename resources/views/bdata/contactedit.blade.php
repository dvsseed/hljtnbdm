<div id="contactedit" class="content" style="display: none;width: 1000px;margin: 0px auto;">
    <table class="table" style="width: 100%">
        <tr>
            <td>就诊日期</td>
            <td width="700px"><input type="date" class="form-control" id="start_date" @if(isset($contact_data['start_date']) && $contact_data['start_date'] != null) value="{{$contact_data['start_date']}}" @endif/></td>
        </tr>
        <tr>
            <td>开药日期</td>
            <td class="form-inline"><div style="width: 300px;float: left;"><input type="text" id="med_date_after" class="form-control"/> &nbsp;天後 &nbsp;</div><div style="width: 384px; float:right"><input type="date" class="form-control" style="width:100%" id="med_date" @if(isset($contact_data['med_date']) && $contact_data['med_date'] != null) value="{{$contact_data['med_date']}}" @endif/></div></td>
        </tr>
        <tr>
            <td>追踪方式</td>
            <td><select class="form-control" id="trace_method" >
                    <option  value="0" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 0) selected @endif>请选择</option>
                    <option  value="1" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 1) selected @endif>电话</option>
                    <option  value="2" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 2) selected @endif>传真</option>
                    <option  value="3" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 3) selected @endif>e-mail</option>
                    <option  value="4" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 4) selected @endif>回诊讨论</option>
                    <option  value="5" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 5) selected @endif>网路平台</option>
                    <option  value="6" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 6) selected @endif>传输线</option>
                    <option  value="7" @if(isset($contact_data['trace_method']) && $contact_data['trace_method'] != null && $contact_data['trace_method'] == 7) selected @endif>其他</option>
                </select></td>
        </tr>
        <tr>
            <td>连络人姓名</td>
            <td><input type="text" class="form-control" id="contact_name" @if(isset($contact_data['contact_name']) && $contact_data['contact_name'] != null) value="{{$contact_data['contact_name']}}" @endif/></td>
        </tr>
        <tr>
            <td>连络说明</td>
            <td><textarea class="form-control" id="contact_description" >@if(isset($contact_data['contact_description']) && $contact_data['contact_description'] != null){{$contact_data['contact_description']}}@endif</textarea></td>
        </tr>
        <tr>
            <td>用药</td>
            <td><textarea class="form-control" id="medicine">@if(isset($contact_data['medicine']) && $contact_data['medicine'] != null){{$contact_data['medicine']}}@endif</textarea></td>
        </tr>
        <tr>
            <td>连络时段</td>
            <td><select class="form-control" id="contact_time">
                    <option value="0" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 0) selected @endif>请选择</option>
                    <option value="1" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 1) selected @endif>早上</option>
                    <option value="2" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 2) selected @endif>下午</option>
                    <option value="3" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 3) selected @endif>晚上</option>
                    <option value="4" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 4) selected @endif>全天</option>
                    <option value="5" @if(isset($contact_data['contact_time']) && $contact_data['contact_time'] != null && $contact_data['contact_time'] == 5) selected @endif>其他</option>
                </select></td>
        </tr>
        <tr>
            <td colspan="2">
                {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'contact_data_save')) !!}
                {!! Form::button('储 存', array('class'=>'btn btn-default', 'id'=>'contact_data_save_btn', 'style' => 'width: 150px; margin: 0 auto')) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    </table>
</div>