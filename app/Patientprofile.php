<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patientprofile extends Model
{
    // 地区
    public static $_area = array(
        "" => "不详", "0" => "道里区", "1" => "道外区", "2" => "南岗区", "3" => "香坊区", "4" => "平房区", "5" => "松北区",
        "6" => "阿城区", "7" => "宾县", "8" => "方正县", "9" => "依兰县", "10" => "巴彦县", "11" => "木兰县", "12" => "延寿县",
        "13" => "通河县", "14" => "双城市", "15" => "尚志市", "16" => "五常市", "17" => "齐齐哈尔市", "18" => "佳木斯市",
        "19" => "鹤岗市", "20" => "大庆市", "21" => "鸡西市", "22" => "双鸭山市", "23" => "伊春市", "24" => "牡丹江市",
        "25" => "黑河市", "26" => "七台河市", "27" => "绥化市", "28" => "大兴安岭地区", "29" => "友谊县", "30" => "林口县",
        "31" => "清河", "32" => "肇东市", "33" => "肇州", "34" => "肇源", "35" => "海伦市", "36" => "建三江", "37" => "安达市",
        "38" => "宝清县", "39" => "青岗县", "40" => "克山县", "41" => "庆安", "42" => "明水", "43" => "嫩江", "44" => "虎林",
        "45" => "加格达奇", "46" => "嘉荫", "47" => "北安", "48" => "密山市", "49" => "铁岭", "50" => "通河县", "51" => "兰西县",
        "52" => "群力", "53" => "海伦", "54" => "拜泉县", "55" => "绥棱县", "56" => "绥芬河", "57" => "铁力", "58" => "方正",
        "59" => "富锦县"
    );
    // 负责医生
    public static $_doctor = array(
        "" => "不详", "0" => "王颖", "1" => "王秀萍", "2" => "李晓星", "3" => "肖树芹", "4" => "姜宝华", "5" => "代志行",
        "6" => "刘雨田", "7" => "刘国信", "8" => "王玉美", "9" => "侯淑敏", "10" => "兰晓", "11" => "张丽丽", "12" => "宋淑清",
        "13" => "王薇", "14" => "范文爽", "15" => "李羚", "16" => "张丽华", "17" => "于秋芝", "18" => "袁爽", "19" => "孙立婷",
        "20" => "孙丹丹", "21" => "徐丰磊", "22" => "韩宏盛", "23" => "王国楠"
    );
    // 患者来源
    public static $_source = array(
        "" => "不详", "0" => "电视", "1" => "户外广告", "2" => "电话回访", "3" => "网络浏览", "4" => "生活报", "5" => "新晚报",
        "6" => "400网站", "7" => "朋友介绍", "8" => "网站"
    );
    // 职业
    public static $_occupation = array(
        "" => "不详", "0" => "工人", "1" => "农民", "2" => "教师", "3" => "学生", "4" => "公务员", "5" => "文职人员",
        "6" => "个体", "7" => "医生", "8" => "工程师", "9" => "会计", "10" => "司机", "11" => "建筑", "12" => "厨师"
    );
    // 语言
    public static $_language = array(
        "" => "请选择", "0" => "国语", "1" => "台语", "2" => "客语", "3" => "原住民语", "4" => "美(英)语", "5" => "越语",
        "6" => "泰语", "7" => "其它语言"
    );

    protected $table = 'patientprofile1';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'pp_patientid', 'pp_personid', 'pp_name', 'pp_birthday', 'pp_age', 'pp_sex', 'pp_height', 'pp_weight', 'pp_tel1', 'pp_tel2', 'pp_mobile1', 'pp_mobile2', 'pp_area', 'pp_doctor', 'pp_remark', 'pp_source', 'pp_occupation', 'pp_address', 'pp_email'];

    protected $dates = ['pp_birthday'];

    public function setppbirthdayAttribute($date)
    {
        if (!empty($date)) $this->attributes['pp_birthday'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function getppbirthdayAttribute($date)
    {
        if (is_null($date))
            $result = "";
        else
            $result = Carbon::parse($date)->toDateString(); // 1975-12-25
        return $result;
    }

    public function hospital_no()
    {
        return $this->hasOne('App\Model\Pdata\HospitalNo','patient_profile_id');
    }


    /**
     * 登录验证规则
     * @return [type] [description]
     */
    protected static function rules()
    {
        return [
            'pp_patientid' => 'required|unique:patientprofile1,pp_patientid|alpha_num',
            'pp_personid' => 'required|unique:patientprofile1,pp_personid|alpha_num',
            'pp_name' => 'required',
            'pp_height' => 'required|numeric|min:0|max:200',
            'pp_weight' => 'required|numeric|min:0|max:200'
        ];
    }

    protected static function updaterules()
    {
        return [
            'pp_name' => 'required',
            'pp_height' => 'required|numeric|min:0|max:200',
            'pp_weight' => 'required|numeric|min:0|max:200'
        ];
    }

    /**
     *
     * 一对一关联
     */
    public function casecare()
    {
        return $this->hasOne('App\CaseCare');
    }

}
