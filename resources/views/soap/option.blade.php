{!! Html::style('css/bdata.css') !!}

<table class="table borderless" id="other_class" style="text-align: center; background-color: lightpink">
    <tr>
        <td class="col-md-3">
            <select id="sub_class" class="form-control" >
                @foreach($sub_classes as $sub_class)
                    <option value="{{$sub_class -> sub_class_pk}}">{{$sub_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
        <td rowspan="11">
            护理卫教项目
            <table >
                @foreach($soa_nurse_classes[0] as $soa_nurse_class)
                    <tr><td style="text-align: left"><input type="checkbox" name="nurse" value="{{$soa_nurse_class -> soa_nurse_class_pk}}" @if(in_array($soa_nurse_class -> soa_nurse_class_pk,$user_soa_nurse_pks) || in_array($soa_nurse_class->soa_nurse_class_pk,$pks0)) checked @endif/>{{$soa_nurse_class -> name}}</td></tr>
                @endforeach
            </table>
            <br/>
            营养卫教项目
            <table style="text-align: left">
                @foreach($soa_nurse_classes[1] as $soa_nurse_class)
                    <tr><td style="text-align: left"><input type="checkbox" name="nurse" value="{{$soa_nurse_class -> soa_nurse_class_pk}}" @if(in_array($soa_nurse_class -> soa_nurse_class_pk,$user_soa_nurse_pks) || in_array($soa_nurse_class->soa_nurse_class_pk,$pks1)) checked @endif/>{{$soa_nurse_class -> name}}</td></tr>
                @endforeach
            </table>
            <br/>
            个人化字串
            <select class="form-control" id="customize_class">
                @foreach($main_classes as $main_class)
                    <option value="{{$main_class -> main_class_pk}}">{{$main_class -> class_name}}</option>
                @endforeach
            </select>
            <br/>
            <select class="form-control" id="customize_type">
                <option value="S">S</option>
                <option value="O">O</option>
                <option value="A">A</option>
                <option value="P">P</option>
                <option value="E">E</option>
                <option value="R">R</option>
            </select>
            <br/>
            <select multiple class="form-control" id="customize_select">
            </select>

            <br/>
            <textarea class="form-control" id="customize_text" style=" height: 150px;"></textarea>
            <br/>
            {!! Form::open(array('url'=>'/soap/','method'=>'POST', 'id'=>'customize')) !!}
            {!! Form::button('提 交', array('class'=>'btn btn-default', 'id'=>'customize_btn')) !!}
            {!! Form::close() !!}
            <br/>
            <table style="width: 100%">
                <tr>
                    <td>就診日期</td>
                </tr>
                <tr>
                    <td><input type="date" class="form-control" id="start_date" @if(isset($user_data['start_date']) && $user_data['start_date'] != null) value="{{$user_data['start_date']}}" @endif/></td>
                </tr>
                <tr>
                    <td>開藥日期</td>
                </tr>
                <tr>
                    <td><input type="date" class="form-control" id="med_date" @if(isset($user_data['med_date']) && $user_data['med_date'] != null) value="{{$user_data['med_date']}}" @endif/></td>
                </tr>
                <tr>
                    <td>追蹤方式</td>
                </tr>
                <tr>
                    <td><select class="form-control" id="trace_method" >
                            <option  value="0" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 0) selected @endif>請選擇</option>
                            <option  value="1" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 1) selected @endif>電話</option>
                            <option  value="2" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 2) selected @endif>傳真</option>
                            <option  value="3" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 3) selected @endif>e-mail</option>
                            <option  value="4" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 4) selected @endif>回診討論</option>
                            <option  value="5" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 5) selected @endif>網路平台</option>
                            <option  value="6" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 6) selected @endif>傳輸線</option>
                            <option  value="7" @if(isset($user_data['trace_method']) && $user_data['trace_method'] != null && $user_data['trace_method'] == 7) selected @endif>其他</option>
                    </select></td>
                </tr>
                <tr>
                    <td>連絡人姓名</td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" id="contact_name" @if(isset($user_data['contact_name']) && $user_data['contact_name'] != null) value="{{$user_data['contact_name']}}" @endif/></td>
                </tr>
                <tr>
                    <td>連絡說明</td>
                </tr>
                <tr>
                    <td><textarea class="form-control" id="contact_description" >@if(isset($user_data['contact_description']) && $user_data['contact_description'] != null){{$user_data['contact_description']}}@endif</textarea></td>
                </tr>
                <tr>
                    <td>用藥</td>
                </tr>
                <tr>
                    <td><textarea class="form-control" id="medicine">@if(isset($user_data['medicine']) && $user_data['medicine'] != null){{$user_data['medicine']}}@endif</textarea></td>
                </tr>
                <tr>
                    <td>連絡時段</td>
                </tr>
                <tr>
                    <td><select class="form-control" id="contact_time">
                            <option value="0" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 0) selected @endif>請選擇</option>
                            <option value="1" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 1) selected @endif>早上</option>
                            <option value="2" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 2) selected @endif>下午</option>
                            <option value="3" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 3) selected @endif>晚上</option>
                            <option value="4" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 4) selected @endif>全天</option>
                            <option value="5" @if(isset($user_data['contact_time']) && $user_data['contact_time'] != null && $user_data['contact_time'] == 5) selected @endif>其他</option>
                        </select></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>S</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="s" style="overflow-x: auto; height: 120px; width: 450px">
                @foreach($soa_classes['S'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>O</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="o" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['O'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>A</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="a" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['A'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>P</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="p" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['P'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <tr>
        <td>E</td>
    </tr>
    <tr>
        <td class="col-md-3">
            <select size = 5 class="form-control" id="e" style="overflow-x: auto; height: 120px">
                @foreach($soa_classes['E'] as $soa_class)
                    <option value="{{$soa_class -> soa_class_pk}}">{{$soa_class -> class_name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>