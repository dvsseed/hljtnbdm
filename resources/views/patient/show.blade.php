@extends('layout')

@section('title')
    患者资料-查
@stop

@section('pactive')
    active
@stop

@section('css')
.form-horizontal .form-group {
        margin-top: 0px;
        margin-bottom: 0px;
}
@stop

@section('content')
    <div class="page-header">
        <h3>病患基本数据 / 查</h3>
    </div>

    <div class="row">
        <div class="col-md-12">

            <form action="#" class="form-horizontal" role="form">
                <div class="form-group">
                     <label for="nome" class="col-md-2 control-label">#</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->id }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_patientid" class="col-md-2 control-label">病历号码</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_patientid }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_personid" class="col-md-2 control-label">身份证号</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_personid }}</div>
                </div>
                <div class="form-group">
                    <label for="account" class="col-md-2 control-label">登入帐号</label>
                    <div class="col-md-10" form-control-static>{{ $account }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_name" class="col-md-2 control-label">姓名</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_name }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_birthday" class="col-md-2 control-label">生日</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_birthday }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_sex" class="col-md-2 control-label">性别</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_sex ? "男" : "女" }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_height" class="col-md-2 control-label">身高(cm)</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_height }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_weight" class="col-md-2 control-label">体重(kg)</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_weight }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_tel1" class="col-md-2 control-label">家用电话1</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_tel1 }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_tel2" class="col-md-2 control-label">家用电话2</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_tel2 }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile1" class="col-md-2 control-label">行动电话1</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_mobile1 }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_mobile2" class="col-md-2 control-label">行动电话2</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_mobile2 }}</div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="pp_area">地区</label>
                     <div class="col-md-10 form-control-static">{{-1==$patientprofile->pp_area ? "不详" : ""}}{{0==$patientprofile->pp_area ? "道里区" : ""}}{{1==$patientprofile->pp_area ? "道外区" : ""}}{{2==$patientprofile->pp_area ? "南岗区" : ""}}{{3==$patientprofile->pp_area ? "香坊区" : ""}}{{4==$patientprofile->pp_area ? "平房区" : ""}}{{5==$patientprofile->pp_area ? "松北区" : ""}}{{6==$patientprofile->pp_area ? "阿城区" : ""}}{{7==$patientprofile->pp_area ? "宾县" : ""}}{{8==$patientprofile->pp_area ? "方正县" : ""}}{{9==$patientprofile->pp_area ? "依兰县" : ""}}{{10==$patientprofile->pp_area ? "巴彦县" : ""}}{{11==$patientprofile->pp_area ? "木兰县" : ""}}{{12==$patientprofile->pp_area ? "延寿县" : ""}}{{13==$patientprofile->pp_area ? "通河县" : ""}}{{14==$patientprofile->pp_area ? "双城市" : ""}}{{15==$patientprofile->pp_area ? "尚志市" : ""}}{{16==$patientprofile->pp_area ? "五常市" : ""}}{{17==$patientprofile->pp_area ? "齐齐哈尔市" : ""}}{{18==$patientprofile->pp_area ? "佳木斯市" : ""}}{{19==$patientprofile->pp_area ? "鹤岗市" : ""}}{{20==$patientprofile->pp_area ? "大庆市" : ""}}{{21==$patientprofile->pp_area ? "鸡西市" : ""}}{{22==$patientprofile->pp_area ? "双鸭山市" : ""}}{{23==$patientprofile->pp_area ? "伊春市" : ""}}{{24==$patientprofile->pp_area ? "牡丹江市" : ""}}{{25==$patientprofile->pp_area ? "黑河市" : ""}}{{26==$patientprofile->pp_area ? "七台河市" : ""}}{{27==$patientprofile->pp_area ? "绥化市" : ""}}{{28==$patientprofile->pp_area ? "大兴安岭地区" : ""}}{{29==$patientprofile->pp_area ? "友谊县" : ""}}{{30==$patientprofile->pp_area ? "林口县" : ""}}{{31==$patientprofile->pp_area ? "清河" : ""}}{{32==$patientprofile->pp_area ? "肇东市" : ""}}{{33==$patientprofile->pp_area ? "肇州" : ""}}{{34==$patientprofile->pp_area ? "肇源" : ""}}{{35==$patientprofile->pp_area ? "海伦市" : ""}}{{36==$patientprofile->pp_area ? "建三江" : ""}}{{37==$patientprofile->pp_area ? "安达市" : ""}}{{38==$patientprofile->pp_area ? "宝清县" : ""}}{{39==$patientprofile->pp_area ? "青岗县" : ""}}{{40==$patientprofile->pp_area ? "克山县" : ""}}{{41==$patientprofile->pp_area ? "庆安" : ""}}{{42==$patientprofile->pp_area ? "明水" : ""}}{{43==$patientprofile->pp_area ? "嫩江" : ""}}{{44==$patientprofile->pp_area ? "虎林" : ""}}{{45==$patientprofile->pp_area ? "加格达奇" : ""}}{{46==$patientprofile->pp_area ? "嘉荫" : ""}}{{47==$patientprofile->pp_area ? "北安" : ""}}{{48==$patientprofile->pp_area ? "密山市" : ""}}{{49==$patientprofile->pp_area ? "铁岭" : ""}}{{50==$patientprofile->pp_area ? "通河县" : ""}}{{51==$patientprofile->pp_area ? "兰西县" : ""}}{{52==$patientprofile->pp_area ? "群力" : ""}}{{53==$patientprofile->pp_area ? "海伦" : ""}}{{54==$patientprofile->pp_area ? "拜泉县" : ""}}{{55==$patientprofile->pp_area ? "绥棱县" : ""}}{{56==$patientprofile->pp_area ? "绥芬河" : ""}}{{57==$patientprofile->pp_area ? "铁力" : ""}}{{58==$patientprofile->pp_area ? "方正" : ""}}{{59==$patientprofile->pp_area ? "富锦县" : ""}}</div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="pp_doctor">负责医生</label>
                     <div class="col-md-10 form-control-static">{{-1==$patientprofile->pp_doctor ? "不详" : ""}}{{0==$patientprofile->pp_doctor ? "王颖" : ""}}{{1==$patientprofile->pp_doctor ? "王秀萍" : ""}}{{2==$patientprofile->pp_doctor ? "李晓星" : ""}}{{3==$patientprofile->pp_doctor ? "肖树芹" : ""}}{{4==$patientprofile->pp_doctor ? "姜宝华" : ""}}{{5==$patientprofile->pp_doctor ? "代志行" : ""}}{{6==$patientprofile->pp_doctor ? "刘雨田" : ""}}{{7==$patientprofile->pp_doctor ? "刘国信" : ""}}{{8==$patientprofile->pp_doctor ? "王玉美" : ""}}{{9==$patientprofile->pp_doctor ? "侯淑敏" : ""}}{{10==$patientprofile->pp_doctor ? "兰晓" : ""}}{{11==$patientprofile->pp_doctor ? "张丽丽" : ""}}{{12==$patientprofile->pp_doctor ? "宋淑清" : ""}}{{13==$patientprofile->pp_doctor ? "王薇" : ""}}{{14==$patientprofile->pp_doctor ? "范文爽" : ""}}{{15==$patientprofile->pp_doctor ? "李羚" : ""}}{{16==$patientprofile->pp_doctor ? "张丽华" : ""}}{{17==$patientprofile->pp_doctor ? "于秋芝" : ""}}{{18==$patientprofile->pp_doctor ? "袁爽" : ""}}{{19==$patientprofile->pp_doctor ? "孙立婷" : ""}}{{20==$patientprofile->pp_doctor ? "孙丹丹" : ""}}{{21==$patientprofile->pp_doctor ? "徐丰磊" : ""}}{{22==$patientprofile->pp_doctor ? "韩宏盛" : ""}}{{23==$patientprofile->pp_doctor ? "王国楠" : ""}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_remark" class="col-md-2 control-label">备注</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_remark }}</div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="pp_source">患者来源</label>
                     <div class="col-md-10 form-control-static">{{-1==$patientprofile->pp_source ? "不详" : ""}}{{0==$patientprofile->pp_source ? "电视" : ""}}{{1==$patientprofile->pp_source ? "户外广告" : ""}}{{2==$patientprofile->pp_source ? "电话回访" : ""}}{{3==$patientprofile->pp_source ? "网络浏览" : ""}}{{4==$patientprofile->pp_source ? "生活报" : ""}}{{5==$patientprofile->pp_source ? "新晚报" : ""}}{{6==$patientprofile->pp_source ? "400网站" : ""}}{{7==$patientprofile->pp_source ? "朋友介绍" : ""}}{{8==$patientprofile->pp_source ? "网站" : ""}}</div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="pp_occupation">职业</label>
                     <div class="col-md-10 form-control-static">{{-1==$patientprofile->pp_occupation ? "不详" : ""}}{{0==$patientprofile->pp_occupation ? "工人" : ""}}{{1==$patientprofile->pp_occupation ? "农民" : ""}}{{2==$patientprofile->pp_occupation ? "教师" : ""}}{{3==$patientprofile->pp_occupation ? "学生" : ""}}{{4==$patientprofile->pp_occupation ? "公务员" : ""}}{{5==$patientprofile->pp_occupation ? "文职人员" : ""}}{{6==$patientprofile->pp_occupation ? "个体" : ""}}{{7==$patientprofile->pp_occupation ? "医生" : ""}}{{8==$patientprofile->pp_occupation ? "工程师" : ""}}{{9==$patientprofile->pp_occupation ? "会计" : ""}}{{10==$patientprofile->pp_occupation ? "司机" : ""}}{{11==$patientprofile->pp_occupation ? "建筑" : ""}}{{12==$patientprofile->pp_occupation ? "厨师" : ""}}</div>
                </div>
                <div class="form-group">
                     <label for="pp_address" class="col-md-2 control-label">联络地址</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_address }}</div>
                </div>
                <div class="form-group">
                     <label for="pp_email" class="col-md-2 control-label">电子邮件</label>
                     <div class="col-md-10 form-control-static">{{ $patientprofile->pp_email }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_contactor" class="col-md-2 control-label">紧急联络人</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_contactor }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_contactor_tel" class="col-md-2 control-label">紧急联络人电话</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_contactor_tel }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_language" class="col-md-2 control-label">语言</label>
                     <div class="col-md-10 form-control-static">{{0==$casecare->cc_language ? "请选择语言" : ""}}{{1==$casecare->cc_language ? "国语" : ""}}{{2==$casecare->cc_language ? "台语" : ""}}{{3==$casecare->cc_language ? "客语" : ""}}{{4==$casecare->cc_language ? "原住民语" : ""}}{{5==$casecare->cc_language ? "美(英)语" : ""}}{{6==$casecare->cc_language ? "越语" : ""}}{{7==$casecare->cc_language ? "泰语" : ""}}{{8==$casecare->cc_language ? "其它语言" : ""}}</div>
                </div>
                <div class="form-group">
                     <label for="cc_mdate" class="col-md-2 control-label">诊断日期</label>
                     <div class="col-md-10 form-control-static">
                          发生于 西元年{{-1==$casecare->cc_mdate ? "不详" : ""}}
                          @for ($i = $year; $i > 1910; $i--)
                              {{$i==$casecare->cc_mdate ? $i : ""}}
                          @endfor
                          年
                          {{-1==$casecare->cc_mdatem ? "不详" : ""}}
                          @for ($i = 1; $i < 13; $i++)
                              {{$i==$casecare->cc_mdatem ? $i : ""}}
                          @endfor
                          月
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_type" class="col-md-2 control-label">症状型态</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_type" id="cc_type0" {{!$casecare->cc_type ? "checked='checked'" : ""}} disabled>其它</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_type" id="cc_type1" {{$casecare->cc_type==1 ? "checked='checked'" : ""}} disabled>Type1</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_type" id="cc_type2" {{$casecare->cc_type==2 ? "checked='checked'" : ""}} disabled>Type2</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_type" id="cc_type3" {{$casecare->cc_type==3 ? "checked='checked'" : ""}} disabled>GDM</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_ibw" class="col-md-2 control-label">IBW</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_ibw }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_bmi" class="col-md-2 control-label">BMI</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_bmi }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_waist" class="col-md-2 control-label">腰围</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_waist }}公分</div>
                </div>
                <div class="form-group">
                     <label for="cc_butt" class="col-md-2 control-label">臀围</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_butt }}公分</div>
                </div>
                <div class="form-group">
                     <label for="cc_status" class="col-md-2 control-label">发病状况</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_status" id="cc_status0" {{empty($casecare->cc_status) ? "checked='checked'" : ""}} disabled>无</label>
                          <label for="cc_status1" class="radio-inline"><input type="radio" value="1" name="cc_status" id="cc_status1" {{$casecare->cc_status ? "checked='checked'" : ""}} disabled>有下列症状：</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c1" {{substr($casecare->cc_status.'000000',0,1)=='1' ? "checked='checked'" : ""}} disabled>口干</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c2" {{substr($casecare->cc_status.'000000',1,1)=='1' ? "checked='checked'" : ""}} disabled>多尿</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c3" {{substr($casecare->cc_status.'000000',2,1)=='1' ? "checked='checked'" : ""}} disabled>饥饿</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c4" {{substr($casecare->cc_status.'000000',3,1)=='1' ? "checked='checked'" : ""}} disabled>疲倦</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_status_c5" {{substr($casecare->cc_status.'000000',4,1)=='1' ? "checked='checked'" : ""}} disabled>其他</label>
                          {{ $casecare->cc_status_other }}
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_drink" class="col-md-2 control-label">有无喝酒</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_drink" id="cc_drink0" {{!$casecare->cc_drink ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_drink" id="cc_drink1" {{$casecare->cc_drink==1 ? "checked='checked'" : ""}} disabled>偶尔</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_drink" id="cc_drink2" {{$casecare->cc_drink==2 ? "checked='checked'" : ""}} disabled>常喝</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_wine" class="col-md-2 control-label">酒名</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_wine }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_wineq" class="col-md-2 control-label">酒量c.c.</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_wineq }}c.c./天</div>
                </div>
                <div class="form-group">
                     <label for="cc_smoke" class="col-md-2 control-label">有无抽烟</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_smoke" id="cc_smoke0" {{!$casecare->cc_smoke ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_smoke" id="cc_smoke1" {{$casecare->cc_smoke>=1 ? "checked='checked'" : ""}} disabled>有</label>
                          {{ $casecare->cc_smoke }}支/天
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_mh" class="col-md-2 control-label">疾病史</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_mh }}(诊断码)</div>
                </div>
                <div class="form-group">
                     <label for="cc_fh" class="col-md-2 control-label">家族病史</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_fh" id="cc_fh0" {{!$casecare->cc_fh ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_fh" id="cc_fh1" {{$casecare->cc_fh==1 ? "checked='checked'" : ""}} disabled>有</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_fh_desc" class="col-md-2 control-label">上列病史</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_fh_desc }}备注描述</div>
                </div>
                <div class="form-group">
                     <label for="cc_drug_allergy" class="col-md-2 control-label">药物过敏</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_drug_allergy" id="cc_drug_allergy0" {{!$casecare->cc_drug_allergy ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_drug_allergy" id="cc_drug_allergy1" {{$casecare->cc_drug_allergy==1 ? "checked='checked'" : ""}} disabled>有</label>
                          {{ $casecare->cc_drug_allergy_name }}对何种药物名称
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_activity" class="col-md-2 control-label">活动量</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_activity" id="cc_activity0" {{!$casecare->cc_activity ? "checked='checked'" : ""}} disabled>非劳动/卧床</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_activity" id="cc_activity1" {{$casecare->cc_activity==1 ? "checked='checked'" : ""}} disabled>轻度</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_activity" id="cc_activity2" {{$casecare->cc_activity==2 ? "checked='checked'" : ""}} disabled>中度</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_activity" id="cc_activity3" {{$casecare->cc_activity==3 ? "checked='checked'" : ""}} disabled>重度</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_medicaretype" class="col-md-2 control-label">医保类型</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_medicaretype" id="cc_medicaretype0" {{!$casecare->cc_medicaretype ? "checked='checked'" : ""}} disabled>省医保</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_medicaretype" id="cc_medicaretype1" {{$casecare->cc_medicaretype==1 ? "checked='checked'" : ""}} disabled>市医保</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_medicaretype" id="cc_medicaretype2" {{$casecare->cc_medicaretype==2 ? "checked='checked'" : ""}} disabled>哈尔滨市城镇居民医保</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_medicaretype" id="cc_medicaretype3" {{$casecare->cc_medicaretype==3 ? "checked='checked'" : ""}} disabled>省农村合作医疗</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_jobtime" class="col-md-2 control-label">工作时间</label>
                     <div class="col-md-4">
                          <label class="radio-inline"><input type="radio" value="1" name="cc_jobtime" id="cc_jobtime0" {{$casecare->cc_jobtime==1 ? "checked='checked'" : ""}} disabled>固定</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_jobtime" id="cc_jobtime1" {{$casecare->cc_jobtime==2 ? "checked='checked'" : ""}} disabled>轮班</label>
                     </div>
                </div>
                <div class="row">
                     <label for="cc_current_use" class="col-md-2 control-label">目前治疗方式</label>
                     <div class="col-md-10 form-control-static">
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use0" {{substr($casecare->cc_current_use.'000000',0,1)=='1' ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use1" {{substr($casecare->cc_current_use.'000000',1,1)=='1' ? "checked='checked'" : ""}} disabled>口服药</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use2" {{substr($casecare->cc_current_use.'000000',2,1)=='1' ? "checked='checked'" : ""}} disabled>胰岛素</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use3" {{substr($casecare->cc_current_use.'000000',3,1)=='1' ? "checked='checked'" : ""}} disabled>饮食控制</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use4" {{substr($casecare->cc_current_use.'000000',4,1)=='1' ? "checked='checked'" : ""}} disabled>中药治疗</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_current_use5" {{substr($casecare->cc_current_use.'000000',5,1)=='1' ? "checked='checked'" : ""}} disabled>以上方式有持续<font color='#ff0000'><b>规则治疗</b></font></label>
                          <label class="checkbox-inline">开始年月
                          {{-1==$casecare->cc_starty ? "不详" : ""}}
                          @for ($i = $year; $i > 1910; $i--)
                              {{$i==$casecare->cc_starty ? $i : ""}}
                          @endfor
                          年
                          {{-1==$casecare->cc_startm ? "不详" : ""}}
                          @for ($i = 1; $i < 13; $i++)
                              {{$i==$casecare->cc_startm ? $i : ""}}
                          @endfor
                          月
                          </label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_hinder">影响学习之因素</label>
                     <div class="col-md-10 form-control-static">
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder0" {{substr($casecare->cc_hinder.'0000000000',0,1)=='1' ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder1" {{substr($casecare->cc_hinder.'0000000000',1,1)=='1' ? "checked='checked'" : ""}} disabled>失聪</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder2" {{substr($casecare->cc_hinder.'0000000000',2,1)=='1' ? "checked='checked'" : ""}} disabled>失明</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder3" {{substr($casecare->cc_hinder.'0000000000',3,1)=='1' ? "checked='checked'" : ""}} disabled>手部不灵活</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder4" {{substr($casecare->cc_hinder.'0000000000',4,1)=='1' ? "checked='checked'" : ""}} disabled>听力障碍</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder5" {{substr($casecare->cc_hinder.'0000000000',5,1)=='1' ? "checked='checked'" : ""}} disabled>视力障碍</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder6" {{substr($casecare->cc_hinder.'0000000000',6,1)=='1' ? "checked='checked'" : ""}} disabled>智力障碍</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder7" {{substr($casecare->cc_hinder.'0000000000',7,1)=='1' ? "checked='checked'" : ""}} disabled>情绪因素</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder8" {{substr($casecare->cc_hinder.'0000000000',8,1)=='1' ? "checked='checked'" : ""}} disabled>疾病因素</label>
                          <label class="checkbox-inline"><input type="checkbox" value="1" name="cc_hinder9" {{substr($casecare->cc_hinder.'0000000000',9,1)=='1' ? "checked='checked'" : ""}} disabled>其他</label>
                          <label class="checkbox-inline">简略说明：{{ $casecare->cc_hinder_desc }}(20字内)</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_act_time_sel" class="col-md-2 control-label">运动次数</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_act_time_sel" id="cc_act_time_sel0" {{!$casecare->cc_act_time ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_act_time_sel" id="cc_act_time_sel1" {{$casecare->cc_act_time ? "checked='checked'" : ""}} disabled>有</label>
                          <label class="radio-inline">{{ $casecare->cc_act_time }}次/周</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_act_kind">运动种类</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_act_kind }}</div>
                </div>
                <div class="form-group">
                     <label for="cc_edu" class="col-md-2 control-label">教育程度</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_edu" id="cc_edu0" {{!$casecare->cc_edu ? "checked='checked'" : ""}} disabled>不识字</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_edu" id="cc_edu1" {{$casecare->cc_edu==1 ? "checked='checked'" : ""}} disabled>识数字</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_edu" id="cc_edu2" {{$casecare->cc_edu==2 ? "checked='checked'" : ""}} disabled>识字</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_edu" id="cc_edu3" {{$casecare->cc_edu==3 ? "checked='checked'" : ""}} disabled>日本教育</label>
                          <label class="radio-inline"><input type="radio" value="4" name="cc_edu" id="cc_edu4" {{$casecare->cc_edu==4 ? "checked='checked'" : ""}} disabled>国小</label>
                          <label class="radio-inline"><input type="radio" value="5" name="cc_edu" id="cc_edu5" {{$casecare->cc_edu==5 ? "checked='checked'" : ""}} disabled>国中</label>
                          <label class="radio-inline"><input type="radio" value="6" name="cc_edu" id="cc_edu6" {{$casecare->cc_edu==6 ? "checked='checked'" : ""}} disabled>高中</label>
                          <label class="radio-inline"><input type="radio" value="7" name="cc_edu" id="cc_edu7" {{$casecare->cc_edu==7 ? "checked='checked'" : ""}} disabled>大专</label>
                          <label class="radio-inline"><input type="radio" value="8" name="cc_edu" id="cc_edu8" {{$casecare->cc_edu==8 ? "checked='checked'" : ""}} disabled>大学</label>
                          <label class="radio-inline"><input type="radio" value="9" name="cc_edu" id="cc_edu9" {{$casecare->cc_edu==9 ? "checked='checked'" : ""}} disabled>硕士</label>
                          <label class="radio-inline"><input type="radio" value="10" name="cc_edu" id="cc_edu10" {{$casecare->cc_edu==10 ? "checked='checked'" : ""}} disabled>博士</label>
                     </div>
                </div>
                <div class="form-group">
                     <label for="cc_careself" class="col-md-2 control-label">自我照顾</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_careself" id="cc_careself0" {{!$casecare->cc_careself ? "checked='checked'" : ""}} disabled>独居</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_careself" id="cc_careself1" {{$casecare->cc_careself==1 ? "checked='checked'" : ""}} disabled>完全独立</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_careself" id="cc_careself2" {{$casecare->cc_careself==2 ? "checked='checked'" : ""}} disabled>需旁人照顾</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_careself" id="cc_careself3" {{$casecare->cc_careself==3 ? "checked='checked'" : ""}} disabled>完全由旁人照顾</label>
                          <label class="radio-inline"><input type="radio" value="4" name="cc_careself" id="cc_careself4" {{$casecare->cc_careself==4 ? "checked='checked'" : ""}} disabled>安养中心{{ $casecare->cc_careself_name }}</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_careman">照顾者名称</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_careman }}</div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_careman_tel">照顾者电话</label>
                     <div class="col-md-10 form-control-static">{{ $casecare->cc_careman_tel }}</div>
                </div>
                <div class="row">
                     <label class="col-md-2 control-label" for="cc_usebsm">使用血糖仪</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm" id="cc_usebsm0" {{!$casecare->cc_usebsm ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm" id="cc_usebsm1" {{$casecare->cc_usebsm ? "checked='checked'" : ""}} disabled>有,</label>
                          <label class="radio-inline">厂牌或型号：
                          @foreach($bsms as $bsm)
                              {{$bsm->id==$casecare->cc_usebsm ? $bsm->bm_name : ""}}
                          @endforeach
                          </label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_usebsm_frq">测试频率</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_usebsm_frq" id="cc_usebsm_frq0" {{!$casecare->cc_usebsm_frq ? "checked='checked'" : ""}} disabled>{{ $casecare->cc_usebsm_unit }}次/周</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_usebsm_frq" id="cc_usebsm_frq1" {{$casecare->cc_usebsm_frq ? "checked='checked'" : ""}} disabled>{{ $casecare->cc_usebsm_unit }}次/月</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_g6pd">G6PD</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_g6pd" id="cc_g6pd0" {{$casecare->cc_g6pd==0 ? "checked='checked'" : ""}}>不详</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_g6pd" id="cc_g6pd1" {{$casecare->cc_g6pd==1 ? "checked='checked'" : ""}} disabled>无</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_g6pd" id="cc_g6pd2" {{$casecare->cc_g6pd==2 ? "checked='checked'" : ""}} disabled>有</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_deathdate">死亡</label>
                     <div class="col-md-10 form-control-static">
                          {{-1==$casecare->cc_deathdate ? "不详" : ""}}
                          @for ($i = $year; $i > 1999; $i--)
                              {{$i==$casecare->cc_deathdate ? $i : ""}}
                          @endfor
                          年
                          {{-1==$casecare->cc_deathdatem ? "不详" : ""}}
                          @for ($i = 1; $i < 13; $i++)
                              {{$i==$casecare->cc_deathdatem ? $i : ""}}
                          @endfor
                          月
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_smartphone">本人是否使用智慧型手机</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone" id="cc_smartphone0" {{!$casecare->cc_smartphone ? "checked='checked'" : ""}} disabled>否</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone" id="cc_smartphone1" {{$casecare->cc_smartphone==1 ? "checked='checked'" : ""}} disabled>是</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_wifi3g">智慧型手机上网功能</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="1" name="cc_wifi3g" id="cc_wifi3g1" {{$casecare->cc_wifi3g==1 ? "checked='checked'" : ""}} disabled>Wi-Fi</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_wifi3g" id="cc_wifi3g2" {{$casecare->cc_wifi3g==2 ? "checked='checked'" : ""}} disabled>行动上网</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_smartphone_family">家属是否使用智慧型手机</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_smartphone_family" id="cc_smartphone_family0" {{!$casecare->cc_smartphone_family ? "checked='checked'" : ""}} disabled>否</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_smartphone_family" id="cc_smartphone_family1" {{$casecare->cc_smartphone_family==1 ? "checked='checked'" : ""}} disabled>是</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_familyupload">家属可否协助传输血糖数值</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_familyupload" id="cc_familyupload0" {{!$casecare->cc_familyupload ? "checked='checked'" : ""}} disabled>否</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_familyupload" id="cc_familyupload1" {{$casecare->cc_familyupload==1 ? "checked='checked'" : ""}} disabled>是</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_uploadtodm">是否愿意将血糖数值传输回共照管理系统</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_uploadtodm" id="cc_uploadtodm0" {{!$casecare->cc_uploadtodm ? "checked='checked'" : ""}} disabled>否</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_uploadtodm" id="cc_uploadtodm1" {{$casecare->cc_uploadtodm==1 ? "checked='checked'" : ""}} disabled>是</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_appexp">是否安装过健康管理App软件</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="0" name="cc_appexp" id="cc_appexp0" {{!$casecare->cc_appexp ? "checked='checked'" : ""}} disabled>否</label>
                          <label class="radio-inline"><input type="radio" value="1" name="cc_appexp" id="cc_appexp1" {{$casecare->cc_appexp==1 ? "checked='checked'" : ""}} disabled>是</label>
                     </div>
                </div>
                <div class="form-group">
                     <label class="col-md-2 control-label" for="cc_lastexam">最近一次验血糖时间</label>
                     <div class="col-md-10 form-control-static">
                          <label class="radio-inline"><input type="radio" value="1" name="cc_lastexam" id="cc_lastexam1" {{$casecare->cc_lastexam==1 ? "checked='checked'" : ""}} disabled>一周内</label>
                          <label class="radio-inline"><input type="radio" value="2" name="cc_lastexam" id="cc_lastexam2" {{$casecare->cc_lastexam==2 ? "checked='checked'" : ""}} disabled>一个月内</label>
                          <label class="radio-inline"><input type="radio" value="3" name="cc_lastexam" id="cc_lastexam3" {{$casecare->cc_lastexam==3 ? "checked='checked'" : ""}} disabled>三个月内</label>
                          <label class="radio-inline"><input type="radio" value="4" name="cc_lastexam" id="cc_lastexam4" {{$casecare->cc_lastexam==4 ? "checked='checked'" : ""}} disabled>半年内</label>
                          <label class="radio-inline"><input type="radio" value="5" name="cc_lastexam" id="cc_lastexam5" {{$casecare->cc_lastexam==5 ? "checked='checked'" : ""}} disabled>半年以上</label>
                     </div>
                </div>

            </form>

            <a class="btn btn-default" href="{{ route('patient.index') }}">返回</a>
            <a class="btn btn-warning" href="{{ route('patient.edit', $patientprofile->id) }}">改</a>
            <form action="{{ route('patient.destroy', $patientprofile->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('确定删除?')) { return true } else { return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">删</button></form>
        </div>
    </div>

@endsection
