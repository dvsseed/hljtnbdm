<?php namespace App\Http\Controllers\Quality;

use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;

class QualityController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	// 对象
	public static $_objects = array(
		"" => "请选择", "0" => "新登录::基本资料(总表)", "1" => "新登录::生理与习惯(总表)", "2" => "新登录::品质指标(总表)", "3" => "新登录::并发症(总表)", "4" => "新登录::生理与习惯明细", "5" => "新登录::并发症明细",
		"6" => "新登录::品质指标明细", "7" => "二年内::基本资料(总表)", "8" => "二年内::生理与习惯(总表)", "9" => "二年内::品质指标(总表)", "10" => "二年内::并发症(总表)", "11" => "二年内::生理与习惯明细", "12" => "二年内::并发症明细",
		"13" => "二年内::品质指标明细", "14" => "区间日期::基本资料(总表)", "15" => "区间日期::生理与习惯(总表)", "16" => "区间日期::品质指标(总表)", "17" => "区间日期::并发症(总表)", "18" => "区间日期::生理与习惯明细",
		"19" => "区间日期::并发症明细", "20" => "区间日期::品质指标明细"
	);
	public static $_fname = array(
		"0" => "新登录_基本资料总表", "1" => "新登录_生理与习惯总表", "2" => "新登录_品质指标总表", "3" => "新登录_并发症总表", "4" => "新登录_生理与习惯明细", "5" => "新登录_并发症明细",
		"6" => "新登录_品质指标明细", "7" => "二年内_基本资料总表", "8" => "二年内_生理与习惯总表", "9" => "二年内_品质指标总表", "10" => "二年内_并发症总表", "11" => "二年内_生理与习惯明细", "12" => "二年内_并发症明细",
		"13" => "二年内_品质指标明细", "14" => "区间日期_基本资料总表", "15" => "区间日期_生理与习惯总表", "16" => "区间日期_品质指标总表", "17" => "区间日期_并发症总表", "18" => "区间日期_生理与习惯明细",
		"19" => "区间日期_并发症明细", "20" => "区间日期_品质指标明细"
	);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$objects = self::$_objects;
//		$today = Carbon::today()->toDateString();
		$year = Carbon::today()->year;
		return view('quality.statistics', compact('objects', 'year'));
	}

	/**
	 * Display a listing of the statistics.
	 *
	 * @return Response
	 */
	public function lists(Request $request)
	{
		$objects = self::$_objects;
		$object = $request->object;
		$header = in_array($object, array_keys($objects)) ? $objects[$object] : "other";
		$fyear = $request->interval_fromyear;
		$fmonth = $request->interval_frommonth;
		$tyear = $request->interval_toyear;
		$tmonth = $request->interval_tomonth;
		$err = 0;
		if($tyear < $fyear) {
			$err = 1;
		}
		if($fyear == $tyear && $tmonth < $fmonth) {
			$err = 1;
		}
		if($err){
			$msg = '区间日期应为：从[较小日期]到[较大日期]';
			session()->flash('message', $msg);
			return view('quality.empty');
		}
		if(strlen($fmonth) == 1) $fmonth = str_pad($fmonth, 2, '0', STR_PAD_LEFT);
		if(strlen($tmonth) == 1) $tmonth = str_pad($tmonth, 2, '0', STR_PAD_LEFT);
		$ifrom = $fyear.$fmonth;
		$ito = $tyear.$tmonth;

		$count = $this->switchcase($object, $ifrom, $ito);
		if(empty($count)) {
			return view('quality.empty');
		} else {
			return view('quality.lists', compact('object', 'header', 'count', 'ifrom', 'ito'));
		}
	}

	public function switchcase($object, $ifrom, $ito)
	{
		switch ($object) {
			case 0:
				$count = $this->list0($object, $ifrom, $ito);
				break;
			case 1:
				$count = $this->list1($object, $ifrom, $ito);
				break;
			case 2:
				$count = $this->list2($object, $ifrom, $ito);
				break;
			case 3:
				$count = $this->list3($object, $ifrom, $ito);
				break;
			case 4:
				$count = $this->list4($object, $ifrom, $ito);
				break;
			case 5:
				$count = $this->list5($object, $ifrom, $ito);
				break;
			case 6:
				$count = $this->list6($object, $ifrom, $ito);
				break;
			case 7:
				$count = $this->list0($object, $ifrom, $ito);
				break;
			case 8:
				$count = $this->list1($object, $ifrom, $ito);
				break;
			case 9:
				$count = $this->list2($object, $ifrom, $ito);
				break;
			case 10:
				$count = $this->list3($object, $ifrom, $ito);
				break;
			case 11:
				$count = $this->list4($object, $ifrom, $ito);
				break;
			case 12:
				$count = $this->list5($object, $ifrom, $ito);
				break;
			case 13:
				$count = $this->list6($object, $ifrom, $ito);
				break;
			case 14:
				$count = $this->list0($object, $ifrom, $ito);
				break;
			case 15:
				$count = $this->list1($object, $ifrom, $ito);
				break;
			case 16:
				$count = $this->list2($object, $ifrom, $ito);
				break;
			case 17:
				$count = $this->list3($object, $ifrom, $ito);
				break;
			case 18:
				$count = $this->list4($object, $ifrom, $ito);
				break;
			case 19:
				$count = $this->list5($object, $ifrom, $ito);
				break;
			case 20:
				$count = $this->list6($object, $ifrom, $ito);
				break;
			default:
				break;
		}
		return $count;
	}

	public function insertdata($object, $ifrom, $ito)
	{
//		DB::statement('TRUNCATE TABLE insertdata');
		if($object >= 0 && $object <= 6) {
			// 新登錄
			$scope = " GROUP BY c.cl_patientid ORDER BY c.cl_patientid, c.created_at";
		} elseif($object >= 7 && $object <= 13) {
			// 二年內
			$scope = " AND (c.cl_case_type != 1) AND (TIMESTAMPDIFF(YEAR, c.created_at, NOW()) <= 2) GROUP BY c.cl_patientid ORDER BY c.cl_patientid, c.created_at desc";
		} else {
			// 區間日期
			$scope = " AND (c.cl_case_type != 1) AND (CONCAT(LEFT(c.created_at,4),SUBSTRING(c.created_at,6,2)) >= '" . $ifrom . "') AND (CONCAT(LEFT(c.created_at,4),SUBSTRING(c.created_at,6,2)) <= '" . $ito . "') GROUP BY c.cl_patientid ORDER BY c.cl_patientid, c.created_at desc";
		}
//		DB::statement("INSERT INTO insertdata SELECT c.id,c.pp_id,c.user_id,c.cl_patientid,c.cl_case_type,c.cl_bmi,c.cl_waist,c.cl_base_sbp,c.cl_base_ebp,c.cl_drinking,c.cl_drinking_other,c.cl_smoking,c.cl_havesmoke,c.cl_quitsmoke,c.cl_periodontal,c.cl_masticatory,c.cl_complications,c.cl_complications_stage,c.cl_complications_other,c.cl_eye_chk8,c.cl_eye_chk8_right_item,c.cl_eye_chk8_left_item,c.cl_blood_hba1c,c.cl_tg,c.cl_ldl,c.cl_egfr,c.cl_cataract,c.cl_coronary_heart,c.cl_coronary_heart_other,c.cl_chh_year,c.cl_chh_month,c.cl_stroke,c.cl_stroke_item,c.cl_stroke_other,c.cl_sh_year,c.cl_sh_month,c.cl_blindness,c.cl_blindness_right_item,c.cl_blindness_left_item,c.cl_bh_year,c.cl_bh_month,c.cl_dialysis,c.cl_dialysis_item,c.cl_dh_year,c.cl_dh_month,c.cl_amputation,c.cl_amputation_right_item,c.cl_amputation_left_item,c.cl_ah_year,c.cl_ah_month,c.cl_amputation_other,c.cl_medical_treatment,c.cl_medical_treatment_other,c.cl_medical_treatment_emergency,u.account,u.name,u.pid,p.pp_patientid,p.pp_birthday,p.pp_age,p.pp_sex,p.pp_height,p.pp_weight,p.educator,cc.patientprofile1_id,cc.cc_mdate,cc.cc_edu,c.created_at FROM caselist AS c LEFT JOIN users AS u ON u.id = c.user_id LEFT JOIN patientprofile1 AS p ON p.user_id = c.user_id LEFT JOIN casecare AS cc ON cc.patientprofile1_id = p.id WHERE (c.cl_case_type != 4) ".$scope);
//		$listdata = DB::select('select * from insertdata');
		$listdata = DB::select("SELECT c.id,c.pp_id,c.user_id,c.cl_patientid,c.cl_case_type,c.cl_bmi,c.cl_waist,c.cl_base_sbp,c.cl_base_ebp,c.cl_drinking,c.cl_drinking_other,c.cl_smoking,c.cl_havesmoke,c.cl_quitsmoke,c.cl_periodontal,c.cl_masticatory,c.cl_complications,c.cl_complications_stage,c.cl_complications_other,c.cl_eye_chk8,c.cl_eye_chk8_right_item,c.cl_eye_chk8_left_item,c.cl_blood_hba1c,c.cl_tg,c.cl_ldl,c.cl_egfr,c.cl_cataract,c.cl_coronary_heart,c.cl_coronary_heart_other,c.cl_chh_year,c.cl_chh_month,c.cl_stroke,c.cl_stroke_item,c.cl_stroke_other,c.cl_sh_year,c.cl_sh_month,c.cl_blindness,c.cl_blindness_right_item,c.cl_blindness_left_item,c.cl_bh_year,c.cl_bh_month,c.cl_dialysis,c.cl_dialysis_item,c.cl_dh_year,c.cl_dh_month,c.cl_amputation,c.cl_amputation_right_item,c.cl_amputation_left_item,c.cl_ah_year,c.cl_ah_month,c.cl_amputation_other,c.cl_medical_treatment,c.cl_medical_treatment_other,c.cl_medical_treatment_emergency,u.account,u.name,u.pid,p.pp_patientid,p.pp_birthday,p.pp_age,p.pp_sex,p.pp_height,p.pp_weight,p.educator,cc.patientprofile1_id,cc.cc_mdate,cc.cc_edu,c.created_at FROM caselist AS c LEFT JOIN users AS u ON u.id = c.user_id LEFT JOIN patientprofile1 AS p ON p.user_id = c.user_id LEFT JOIN casecare AS cc ON cc.patientprofile1_id = p.id WHERE (c.cl_case_type != 4) ".$scope);
		return $listdata;
	}

	public function loopdata($listdata, $fcnt)
	{
		$cnt = 0;
		foreach ($listdata as $first) {
			switch ($fcnt) {
				case "c01":
					if(substr($first->cl_patientid, 16, 1) % 2 == 1) $cnt++;
					break;
				case "c02":
					if(substr($first->cl_patientid,16,1) % 2 == 0) $cnt++;
					break;
				case "c11":
					if(substr($first->cl_patientid,6,4)-1911 < 15) $cnt++;
					break;
				case "c12":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >=15 && $comp < 20) $cnt++;
					break;
				case "c13":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 20 && $comp < 25) $cnt++;
					break;
				case "c14":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 25 && $comp < 30) $cnt++;
					break;
				case "c15":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 30 && $comp < 35) $cnt++;
					break;
				case "c16":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 35 && $comp < 40) $cnt++;
					break;
				case "c17":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 40 && $comp < 45) $cnt++;
					break;
				case "c18":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 45 && $comp < 50) $cnt++;
					break;
				case "c19":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 50 && $comp < 55) $cnt++;
					break;
				case "c110":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 55 && $comp < 60) $cnt++;
					break;
				case "c111":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 60 && $comp < 65) $cnt++;
					break;
				case "c112":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 65 && $comp < 70) $cnt++;
					break;
				case "c113":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 70 && $comp < 75) $cnt++;
					break;
				case "c114":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 75 && $comp < 80) $cnt++;
					break;
				case "c115":
					$comp = substr($first->cl_patientid,6,4) - 1911;
					if($comp >= 80 && $comp < 85) $cnt++;
					break;
				case "c116":
					if(substr($first->cl_patientid,6,4)-1911 >= 85) $cnt++;
					break;
				case "c21":
					if(date('Y')-$first->cc_mdate < 1) $cnt++;
					break;
				case "c22":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 1 && $comp < 5) $cnt++;
					break;
				case "c23":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 5 && $comp < 10) $cnt++;
					break;
				case "c24":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 10 && $comp < 15) $cnt++;
					break;
				case "c25":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 15 && $comp < 20) $cnt++;
					break;
				case "c26":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 20 && $comp < 25) $cnt++;
					break;
				case "c27":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 25 && $comp < 30) $cnt++;
					break;
				case "c28":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 30 && $comp < 35) $cnt++;
					break;
				case "c29":
					$comp = date('Y') - $first->cc_mdate;
					if($comp >= 35 && $comp < 40) $cnt++;
					break;
				case "c210":
					if(date('Y') - $first->cc_mdate >= 40) $cnt++;
					break;
				case "c31":
					if($first->cc_edu == 0) $cnt++;
					break;
				case "c32":
					if($first->cc_edu == 1) $cnt++;
					break;
				case "c33":
					if($first->cc_edu == 2) $cnt++;
					break;
				case "c34":
					if($first->cc_edu == 3) $cnt++;
					break;
				case "c35":
					if($first->cc_edu == 4) $cnt++;
					break;
				case "c36":
					if($first->cc_edu == 5) $cnt++;
					break;
				case "c37":
					if($first->cc_edu == 6) $cnt++;
					break;
				case "a01":
					if($first->cl_bmi < 18.5) $cnt++;
					break;
				case "a02":
					$comp = $first->cl_bmi;
					if($comp >= 18.5 && $comp < 22) $cnt++;
					break;
				case "a03":
					$comp = $first->cl_bmi;
					if($comp >= 22 && $comp < 23) $cnt++;
					break;
				case "a04":
					$comp = $first->cl_bmi;
					if($comp >= 23 && $comp < 24) $cnt++;
					break;
				case "a05":
					$comp = $first->cl_bmi;
					if($comp >= 24 && $comp < 27) $cnt++;
					break;
				case "a06":
					$comp = $first->cl_bmi;
					if($comp >= 27 && $comp < 30) $cnt++;
					break;
				case "a07":
					$comp = $first->cl_bmi;
					if($comp >= 30 && $comp < 35) $cnt++;
					break;
				case "a08":
					$comp = $first->cl_bmi;
					if($comp >= 35 && $comp < 40) $cnt++;
					break;
				case "a09":
					if($first->cl_bmi >= 40) $cnt++;
					break;
				case "a11":
					if($first->pp_sex == 1 && $first->cl_waist < 90) $cnt++;
					break;
				case "a12":
					if($first->pp_sex == 0 && $first->cl_waist < 80) $cnt++;
					break;
				case "a21":
					if($first->cl_smoking == 1) $cnt++;
					break;
				case "a31":
					$comp = $first->cl_drinking_other;
					if($comp === NULL) $comp = 0;
					if($comp > 0) $cnt++;
					break;
				case "a41":
					$comp = $first->cl_periodontal;
					if($comp === NULL) $comp = 0;
					if($comp > 0) $cnt++;
					break;
				case "a51":
					$comp = $first->cl_masticatory;
					if($comp === NULL) $comp = 0;
					if($comp > 0) $cnt++;
					break;
				case "b01":
					if($first->cl_blood_hba1c < 6) $cnt++;
					break;
				case "b02":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 6 && $comp < 6.5) $cnt++;
					break;
				case "b03":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 6.5 && $comp < 7) $cnt++;
					break;
				case "b04":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 7 && $comp < 7.5) $cnt++;
					break;
				case "b05":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 7.5 && $comp < 8) $cnt++;
					break;
				case "b06":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 8 && $comp < 8.5) $cnt++;
					break;
				case "b07":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 8.5 && $comp < 9) $cnt++;
					break;
				case "b08":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 9 && $comp < 9.5) $cnt++;
					break;
				case "b09":
					$comp = $first->cl_blood_hba1c;
					if($comp >= 9.5 && $comp < 10) $cnt++;
					break;
				case "b010":
					if($first->cl_blood_hba1c >= 10) $cnt++;
					break;
				case "b11":
					if($first->cl_ldl < 1.81) $cnt++;
					break;
				case "b12":
					$comp = $first->cl_ldl;
					if($comp >= 1.81 && $comp < 2.59) $cnt++;
					break;
				case "b13":
					$comp = $first->cl_ldl;
					if($comp >= 2.59 && $comp < 3.37) $cnt++;
					break;
				case "b14":
					if($first->cl_ldl >= 3.37) $cnt++;
					break;
				case "b21":
					if($first->cl_tg < 1.7) $cnt++;
					break;
				case "b22":
					$comp = $first->cl_tg;
					if($comp >= 1.7 && $comp < 2.26) $cnt++;
					break;
				case "b23":
					$comp = $first->cl_tg;
					if($comp >= 2.26 && $comp < 5.65) $cnt++;
					break;
				case "b24":
					if($first->cl_tg >= 5.65) $cnt++;
					break;
				case "b31":
					if($first->cl_egfr >= 90) $cnt++;
					break;
				case "b32":
					$comp = $first->cl_egfr;
					if($comp >= 60 && $comp < 90) $cnt++;
					break;
				case "b33":
					$comp = $first->cl_egfr;
					if($comp >= 45 && $comp < 60) $cnt++;
					break;
				case "b34":
					$comp = $first->cl_egfr;
					if($comp >= 30 && $comp < 45) $cnt++;
					break;
				case "b35":
					$comp = $first->cl_egfr;
					if($comp >= 15 && $comp < 30) $cnt++;
					break;
				case "b36":
					if($first->cl_egfr < 15) $cnt++;
					break;
				case "b41":
					if($first->cl_base_sbp < 120 && $first->cl_base_ebp < 80) $cnt++;
					break;
				case "b42":
					if($first->cl_base_sbp < 130 && $first->cl_base_ebp < 80) $cnt++;
					break;
				case "b43":
					if($first->cl_base_sbp < 140 && $first->cl_base_ebp < 80) $cnt++;
					break;
				case "b44":
					if($first->cl_base_sbp < 150 && $first->cl_base_ebp < 90) $cnt++;
					break;
				case "d01":
					if(substr($first->cl_complications,0,1) == "1") $cnt++;
					break;
				case "d02":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 1) $cnt++;
					break;
				case "d03":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 2) $cnt++;
					break;
				case "d04":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 3) $cnt++;
					break;
				case "d05":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 4) $cnt++;
					break;
				case "d06":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 5) $cnt++;
					break;
				case "d07":
					$comp = $first->cl_complications_stage;
					if($comp === NULL) $comp = 0;
					if($comp == 6) $cnt++;
					break;
				case "d11":
					if(substr($first->cl_complications,2,1) == "1") $cnt++;
					break;
				case "d21":
					if(substr($first->cl_complications,2,1) == "1") $cnt++;
					break;
				case "d31":
					if(substr($first->cl_eye_chk8,1,1) == "1" || substr($first->cl_eye_chk8,2,1) == "1" || $first->cl_eye_chk8_right_item >= 1 || $first->cl_eye_chk8_left_item >= 1) $cnt++;
					break;
				case "d41":
					if(substr($first->cl_cataract,1,1) == "1" || substr($first->cl_cataract,2,1) == "1") $cnt++;
					break;
				case "d51":
					if($first->cl_coronary_heart == 1) $cnt++;
					break;
				case "d52":
					if(!is_null($first->cl_coronary_heart_other) && $first->cl_chh_year != -1 && date('Y')-$first->cl_chh_year == 0 && $first->cl_chh_month != -1 && date('m')-$first->cl_chh_month >= 1) $cnt++;
					break;
				case "d53":
					if(!is_null($first->cl_coronary_heart_other) && $first->cl_chh_year != -1 && date('Y')-$first->cl_chh_year >= 1) $cnt++;
					break;
				case "d61":
					if($first->cl_stroke == 1) $cnt++;
					break;
				case "d62":
					if(!is_null($first->cl_stroke_other) && $first->cl_sh_year != -1 && date('Y')-$first->cl_sh_year == 0 && $first->cl_sh_month != -1 && date('m')-$first->cl_sh_month >= 1 || $first->cl_stroke_item >= 1) $cnt++;
					break;
				case "d63":
					if(!is_null($first->cl_stroke_other) && $first->cl_sh_year != -1 && date('Y')-$first->cl_sh_year >= 1 || $first->cl_stroke_item >= 1) $cnt++;
					break;
				case "d71":
					if(substr($first->cl_blindness,0,1) == "1") $cnt++;
					break;
				case "d72":
					if((substr($first->cl_blindness,1,1) == "1" && $first->cl_bh_year != -1 && date('Y')-$first->cl_bh_year == 0 && $first->cl_bh_month != -1 && date('m')-$first->cl_bh_month >= 1) || substr($first->cl_blindness,3,1) == "1" || $first->cl_blindness_right_item >= 1 || $first->cl_blindness_left_item >= 1) $cnt++;
					break;
				case "d73":
					if((substr($first->cl_blindness,2,1) == "1" && $first->cl_bh_year != -1 && date('Y')-$first->cl_bh_year >= 1) || substr($first->cl_blindness,2,1) == "1" || $first->cl_blindness_right_item >= 1 || $first->cl_blindness_left_item >= 1) $cnt++;
					break;
				case "d81":
					if($first->cl_dialysis == 1) $cnt++;
					break;
				case "d82":
					if($first->cl_dialysis_item >= 1 && $first->cl_dh_year != -1 && date('Y')-$first->cl_dh_year == 0 && $first->cl_dh_month != -1 && date('m')-$first->cl_dh_month >= 1) $cnt++;
					break;
				case "d83":
					if($first->cl_dialysis_item >= 1 && $first->cl_dh_year != -1 && date('Y')-$first->cl_dh_year >= 1) $cnt++;
					break;
				case "d91":
					if(substr($first->cl_amputation,0,1) == "1") $cnt++;
					break;
				case "d92":
					if((substr($first->cl_amputation,1,1) == "1" && $first->cl_ah_year != -1 && date('Y')-$first->cl_ah_year == 0 && $first->cl_ah_month != -1 && date('m')-$first->cl_ah_month >= 1) || substr($first->cl_amputation,2,1) == "1" || !is_null($first->cl_amputation_other) || $first->cl_amputation_right_item >= 1 || $first->cl_amputation_left_item >= 1) $cnt++;
					break;
				case "d93":
					if((substr($first->cl_amputation,2,1) == "1" && $first->cl_ah_year != -1 && date('Y')-$first->cl_ah_year >= 1) || substr($first->cl_amputation,2,1) == "1" || !is_null($first->cl_amputation_other) || $first->cl_amputation_right_item >= 1 || $first->cl_amputation_left_item >= 1) $cnt++;
					break;
				case "d101":
					if(!is_null($first->cl_medical_treatment_other) || $first->cl_medical_treatment_emergency >= 1) $cnt++;
					break;
				default:
					break;
			}
		}
		return $cnt;
	}

	public function list0($object, $ifrom, $ito)
	{
		// 性别-总笔数
//		$count0 = DB::select(DB::raw('SELECT COUNT(c.cl_patientid) AS c_count FROM caselist AS c LEFT JOIN patientprofile1 AS p ON p.user_id = c.user_id WHERE c.cl_case_type != 4 ORDER BY c.cl_patientid, c.created_at DESC'));
//		$sql = DB::table('caselist')
//			->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
//			->select('caselist.cl_patientid')
//			->where('caselist.cl_case_type', '!=', 4)
//			->groupBy('caselist.cl_patientid')
//			->orderBy('caselist.cl_patientid')
//			->orderBy('caselist.created_at')
//			->get();
		$listdata = $this->insertdata($object, $ifrom, $ito);
		if(empty($listdata)) {
			$count = array();
		} else {
			$count[0][0] = count($listdata);
			// 性别-男
			$count[0][1] = $this->loopdata($listdata, "c01");
			// 性别-女
			$count[0][2] = $this->loopdata($listdata, "c02");
			// 年龄 <15
			$count[1][1] = $this->loopdata($listdata, "c11");
			// 年龄 ≥15~<20
			$count[1][2] = $this->loopdata($listdata, "c12");
			// 年龄 ≥20~<25
			$count[1][3] = $this->loopdata($listdata, "c13");
			// 年龄 ≥25~<30
			$count[1][4] = $this->loopdata($listdata, "c14");
			// 年龄 ≥30~<35
			$count[1][5] = $this->loopdata($listdata, "c15");
			// 年龄 ≥35~<40
			$count[1][6] = $this->loopdata($listdata, "c16");
			// 年龄 ≥40~<45
			$count[1][7] = $this->loopdata($listdata, "c17");
			// 年龄 ≥45~<50
			$count[1][8] = $this->loopdata($listdata, "c18");
			// 年龄 ≥50~<55
			$count[1][9] = $this->loopdata($listdata, "c19");
			// 年龄 ≥55~<60
			$count[1][10] = $this->loopdata($listdata, "c110");
			// 年龄 ≥60~<65
			$count[1][11] = $this->loopdata($listdata, "c111");
			// 年龄 ≥65~<70
			$count[1][12] = $this->loopdata($listdata, "c112");
			// 年龄 ≥70~<75
			$count[1][13] = $this->loopdata($listdata, "c113");
			// 年龄 ≥75~<80
			$count[1][14] = $this->loopdata($listdata, "c114");
			// 年龄 ≥80~<85
			$count[1][15] = $this->loopdata($listdata, "c115");
			// 年龄 ≥85
			$count[1][16] = $this->loopdata($listdata, "c116");
			// 罹病年 <1年
			$count[2][1] = $this->loopdata($listdata, "c21");
			// 罹病年 ≥1~<5年
			$count[2][2] = $this->loopdata($listdata, "c22");
			// 罹病年 ≥5~<10年
			$count[2][3] = $this->loopdata($listdata, "c23");
			// 罹病年 ≥10~<15年
			$count[2][4] = $this->loopdata($listdata, "c24");
			// 罹病年 ≥15~<20年
			$count[2][5] = $this->loopdata($listdata, "c25");
			// 罹病年 ≥20~<25年
			$count[2][6] = $this->loopdata($listdata, "c26");
			// 罹病年 ≥25~<30年
			$count[2][7] = $this->loopdata($listdata, "c27");
			// 罹病年 ≥30~<35年
			$count[2][8] = $this->loopdata($listdata, "c28");
			// 罹病年 ≥35~<40年
			$count[2][9] = $this->loopdata($listdata, "c29");
			// 罹病年 ≥40
			$count[2][10] = $this->loopdata($listdata, "c210");
			// 教育程度 不识字
			$count[3][1] = $this->loopdata($listdata, "c31");
			// 教育程度 识字
			$count[3][2] = $this->loopdata($listdata, "c32");
			// 教育程度 小学
			$count[3][3] = $this->loopdata($listdata, "c33");
			// 教育程度 初中
			$count[3][4] = $this->loopdata($listdata, "c34");
			// 教育程度 高中
			$count[3][5] = $this->loopdata($listdata, "c35");
			// 教育程度 大专
			$count[3][6] = $this->loopdata($listdata, "c36");
			// 教育程度 大学或以上
			$count[3][7] = $this->loopdata($listdata, "c37");
		}
		return $count;
	}

	public function list1($object, $ifrom, $ito)
	{
		// BMI-总笔数
		$listdata = $this->insertdata($object, $ifrom, $ito);
		if(empty($listdata)) {
			$count = array();
		} else {
			$count[0][0] = count($listdata);
			// BMI <18.5
			$count[0][1] = $this->loopdata($listdata, "a01");
			// BMI ≥18.5~<22
			$count[0][2] = $this->loopdata($listdata, "a02");
			// BMI ≥22~<23
			$count[0][3] = $this->loopdata($listdata, "a03");
			// BMI ≥23~<24
			$count[0][4] = $this->loopdata($listdata, "a04");
			// BMI ≥24~<27
			$count[0][5] = $this->loopdata($listdata, "a05");
			// BMI ≥27~<30
			$count[0][6] = $this->loopdata($listdata, "a06");
			// BMI ≥30~<35
			$count[0][7] = $this->loopdata($listdata, "a07");
			// BMI ≥35~<40
			$count[0][8] = $this->loopdata($listdata, "a08");
			// BMI ≥40
			$count[0][9] = $this->loopdata($listdata, "a09");
			// 腰围 男性<90
			$count[1][1] = $this->loopdata($listdata, "a11");
			// 腰围 女性<80
			$count[1][2] = $this->loopdata($listdata, "a12");
			// 吸烟
			$count[2][1] = $this->loopdata($listdata, "a21");
			// 饮酒
			$count[3][1] = $this->loopdata($listdata, "a31");
			// 牙周病
			$count[4][1] = $this->loopdata($listdata, "a41");
			// 咀嚼
			$count[5][1] = $this->loopdata($listdata, "a51");
		}
		return $count;
	}

	public function list2($object, $ifrom, $ito)
	{
		// A1C-总笔数
		$listdata = $this->insertdata($object, $ifrom, $ito);
		if(empty($listdata)) {
			$count = array();
		} else {
			$count[0][0] = count($listdata);
			// A1C <6.0
			$count[0][1] = $this->loopdata($listdata, "b01");
			// A1C ≥6.0~<6.5
			$count[0][2] = $this->loopdata($listdata, "b02");
			// A1C ≥6.5~<7.0
			$count[0][3] = $this->loopdata($listdata, "b03");
			// A1C ≥7.0~<7.5
			$count[0][4] = $this->loopdata($listdata, "b04");
			// A1C ≥7.5~<8.0
			$count[0][5] = $this->loopdata($listdata, "b05");
			// A1C ≥8.0~<8.5
			$count[0][6] = $this->loopdata($listdata, "b06");
			// A1C ≥8.5~<9.0
			$count[0][7] = $this->loopdata($listdata, "b07");
			// A1C ≥9.0~<9.5
			$count[0][8] = $this->loopdata($listdata, "b08");
			// A1C ≥9.5~<10.0
			$count[0][9] = $this->loopdata($listdata, "b09");
			// A1C ≥10.0
			$count[0][10] = $this->loopdata($listdata, "b010");
			// LDL <1.81
			$count[1][1] = $this->loopdata($listdata, "b11");
			// LDL ≥1.81~<2.59
			$count[1][2] = $this->loopdata($listdata, "b12");
			// LDL ≥2.59~<3.37
			$count[1][3] = $this->loopdata($listdata, "b13");
			// LDL ≥3.37
			$count[1][4] = $this->loopdata($listdata, "b14");
			// TG <1.70
			$count[2][1] = $this->loopdata($listdata, "b21");
			// TG ≥1.70~<2.26
			$count[2][2] = $this->loopdata($listdata, "b22");
			// TG ≥2.26~<5.65
			$count[2][3] = $this->loopdata($listdata, "b23");
			// TG ≥5.65
			$count[2][4] = $this->loopdata($listdata, "b24");
			// eGFR ≥90
			$count[3][1] = $this->loopdata($listdata, "b31");
			// eGFR <90~≥60
			$count[3][2] = $this->loopdata($listdata, "b32");
			// eGFR <60~≥45
			$count[3][3] = $this->loopdata($listdata, "b33");
			// eGFR <45~≥30
			$count[3][4] = $this->loopdata($listdata, "b34");
			// eGFR <30~≥15
			$count[3][5] = $this->loopdata($listdata, "b35");
			// eGFR <15
			$count[3][6] = $this->loopdata($listdata, "b36");
			// BP <120/80
			$count[4][1] = $this->loopdata($listdata, "b41");
			// BP <130/80
			$count[4][2] = $this->loopdata($listdata, "b42");
			// BP <140/80
			$count[4][3] = $this->loopdata($listdata, "b43");
			// BP <150/90
			$count[4][4] = $this->loopdata($listdata, "b44");
		}
		return $count;
	}

	public function list3($object, $ifrom, $ito)
	{
		// 肾病变-总笔数
		$listdata = $this->insertdata($object, $ifrom, $ito);
		if(empty($listdata)) {
			$count = array();
		} else {
			$count[0][0] = count($listdata);
			// 肾病变 无
			$count[0][1] = $this->loopdata($listdata, "d01");
			// 肾病变 stage1
			$count[0][2] = $this->loopdata($listdata, "d02");
			// 肾病变 stage2
			$count[0][3] = $this->loopdata($listdata, "d03");
			// 肾病变 stage3a
			$count[0][4] = $this->loopdata($listdata, "d04");
			// 肾病变 stage3b
			$count[0][5] = $this->loopdata($listdata, "d05");
			// 肾病变 stage4
			$count[0][6] = $this->loopdata($listdata, "d06");
			// 肾病变 stage5
			$count[0][7] = $this->loopdata($listdata, "d07");
			// 周边血管病变 有
			$count[1][1] = $this->loopdata($listdata, "d11");
			// 神经病变 有
			$count[2][1] = $this->loopdata($listdata, "d21");
			// 视网膜病变 有
			$count[3][1] = $this->loopdata($listdata, "d31");
			// 白内障 有
			$count[4][1] = $this->loopdata($listdata, "d41");
			// 冠心病 无
			$count[5][1] = $this->loopdata($listdata, "d51");
			// 冠心病 有，发生时间<1年
			$count[5][2] = $this->loopdata($listdata, "d52");
			// 冠心病 有，发生时间≥1年
			$count[5][3] = $this->loopdata($listdata, "d53");
			// 脑中风 无
			$count[6][1] = $this->loopdata($listdata, "d61");
			// 脑中风 有，发生时间<1年
			$count[6][2] = $this->loopdata($listdata, "d62");
			// 脑中风 有，发生时间≥1年
			$count[6][3] = $this->loopdata($listdata, "d63");
			// 失明 无
			$count[7][1] = $this->loopdata($listdata, "d71");
			// 失明 有，发生时间<1年
			$count[7][2] = $this->loopdata($listdata, "d72");
			// 失明 有，发生时间≥1年
			$count[7][3] = $this->loopdata($listdata, "d73");
			// 透析 无
			$count[8][1] = $this->loopdata($listdata, "d81");
			// 透析 有，发生时间<1年
			$count[8][2] = $this->loopdata($listdata, "d82");
			// 透析 有，发生时间≥1年
			$count[8][3] = $this->loopdata($listdata, "d83");
			// 下肢截肢 无
			$count[9][1] = $this->loopdata($listdata, "d91");
			// 下肢截肢 有，发生时间<1年
			$count[9][2] = $this->loopdata($listdata, "d92");
			// 下肢截肢 有，发生时间≥1年
			$count[9][3] = $this->loopdata($listdata, "d93");
			// 高低血糖就医 有
			$count[10][1] = $this->loopdata($listdata, "d101");
		}
		return $count;
	}

	public function list4($object, $ifrom, $ito)
	{
		// 生理與習慣明細
		if($object >= 0 && $object <= 6) {
			// 新登錄
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_waist', 'caselist.cl_smoking', DB::raw("IFNULL(caselist.cl_drinking_other,0) AS drinking"), DB::raw("IFNULL(caselist.cl_periodontal, 0) AS periodontal"),	DB::raw("IFNULL(caselist.cl_masticatory, 0) AS masticatory"))
				->where('caselist.cl_case_type', '!=', 4)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at')
				->get();
		} elseif($object >= 7 && $object <= 13) {
			// 二年內
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_waist', 'caselist.cl_smoking', DB::raw("IFNULL(caselist.cl_drinking_other,0) AS drinking"), DB::raw("IFNULL(caselist.cl_periodontal, 0) AS periodontal"),	DB::raw("IFNULL(caselist.cl_masticatory, 0) AS masticatory"))
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('TIMESTAMPDIFF(YEAR, caselist.created_at, NOW())'), '<=', 2)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		} else {
			// 區間日期
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_waist', 'caselist.cl_smoking', DB::raw("IFNULL(caselist.cl_drinking_other,0) AS drinking"), DB::raw("IFNULL(caselist.cl_periodontal, 0) AS periodontal"),	DB::raw("IFNULL(caselist.cl_masticatory, 0) AS masticatory"))
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '>=', DB::raw("'".$ifrom."'"))
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '<=', DB::raw("'".$ito."'"))
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		}
		$count = $sql;
		return $count;
	}

	public function list5($object, $ifrom, $ito)
	{
		// 併發症明細
		if($object >= 0 && $object <= 6) {
			// 新登錄
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', DB::raw("(CASE IFNULL(caselist.cl_complications_stage,0) WHEN 1 THEN 'stage1' WHEN 2 THEN 'stage2' WHEN 3 THEN 'stage3a' WHEN 4 THEN 'stage3b' WHEN 5 THEN 'stage4' WHEN 6 THEN 'stage5' END) AS stage"), DB::raw('SUBSTRING(caselist.cl_complications,3,1) AS complication3'), DB::raw('SUBSTRING(caselist.cl_complications,2,1) AS complication2'), DB::raw("NOT LEFT(caselist.cl_eye_chk8,1) AS eye8"), DB::raw("NOT LEFT(caselist.cl_cataract,1) AS cataract"), DB::raw("NOT caselist.cl_coronary_heart AS heart"), DB::raw("NOT caselist.cl_stroke AS stroke"), DB::raw("NOT LEFT(caselist.cl_blindness,1) AS blindness"), DB::raw("NOT caselist.cl_dialysis AS dialysis"), DB::raw("NOT LEFT(caselist.cl_amputation,1) AS amputation"), DB::raw("NOT caselist.cl_medical_treatment AS treatment"))
				->where('caselist.cl_case_type', '!=', 4)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at')
				->get();
		} elseif($object >= 7 && $object <= 13) {
			// 二年內
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', DB::raw("(CASE IFNULL(caselist.cl_complications_stage,0) WHEN 1 THEN 'stage1' WHEN 2 THEN 'stage2' WHEN 3 THEN 'stage3a' WHEN 4 THEN 'stage3b' WHEN 5 THEN 'stage4' WHEN 6 THEN 'stage5' END) AS stage"), DB::raw('SUBSTRING(caselist.cl_complications,3,1) AS complication3'), DB::raw('SUBSTRING(caselist.cl_complications,2,1) AS complication2'), DB::raw("NOT LEFT(caselist.cl_eye_chk8,1) AS eye8"), DB::raw("NOT LEFT(caselist.cl_cataract,1) AS cataract"), DB::raw("NOT caselist.cl_coronary_heart AS heart"), DB::raw("NOT caselist.cl_stroke AS stroke"), DB::raw("NOT LEFT(caselist.cl_blindness,1) AS blindness"), DB::raw("NOT caselist.cl_dialysis AS dialysis"), DB::raw("NOT LEFT(caselist.cl_amputation,1) AS amputation"), DB::raw("NOT caselist.cl_medical_treatment AS treatment"))
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('TIMESTAMPDIFF(YEAR, caselist.created_at, NOW())'), '<=', 2)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		} else {
			// 區間日期
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', DB::raw("(CASE IFNULL(caselist.cl_complications_stage,0) WHEN 1 THEN 'stage1' WHEN 2 THEN 'stage2' WHEN 3 THEN 'stage3a' WHEN 4 THEN 'stage3b' WHEN 5 THEN 'stage4' WHEN 6 THEN 'stage5' END) AS stage"), DB::raw('SUBSTRING(caselist.cl_complications,3,1) AS complication3'), DB::raw('SUBSTRING(caselist.cl_complications,2,1) AS complication2'), DB::raw("NOT LEFT(caselist.cl_eye_chk8,1) AS eye8"), DB::raw("NOT LEFT(caselist.cl_cataract,1) AS cataract"), DB::raw("NOT caselist.cl_coronary_heart AS heart"), DB::raw("NOT caselist.cl_stroke AS stroke"), DB::raw("NOT LEFT(caselist.cl_blindness,1) AS blindness"), DB::raw("NOT caselist.cl_dialysis AS dialysis"), DB::raw("NOT LEFT(caselist.cl_amputation,1) AS amputation"), DB::raw("NOT caselist.cl_medical_treatment AS treatment"))
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '>=', DB::raw("'".$ifrom."'"))
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '<=', DB::raw("'".$ito."'"))
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		}
		$count = $sql;
		return $count;
	}

	public function list6($object, $ifrom, $ito)
	{
		// 品質指標明細
		if($object >= 0 && $object <= 6) {
			// 新登錄
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_blood_hba1c', 'caselist.cl_ldl', 'caselist.cl_tg', 'caselist.cl_egfr', 'caselist.cl_base_sbp', 'caselist.cl_base_ebp')
				->where('caselist.cl_case_type', '!=', 4)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at')
				->get();
		} elseif($object >= 7 && $object <= 13) {
			// 二年內
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_blood_hba1c', 'caselist.cl_ldl', 'caselist.cl_tg', 'caselist.cl_egfr', 'caselist.cl_base_sbp', 'caselist.cl_base_ebp')
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('TIMESTAMPDIFF(YEAR, caselist.created_at, NOW())'), '<=', 2)
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		} else {
			// 區間日期
			$sql = DB::table('caselist')
				->leftjoin('users', 'users.id', '=', 'caselist.user_id')
				->leftjoin('patientprofile1', 'patientprofile1.user_id', '=', 'caselist.user_id')
				->leftjoin('casecare', 'casecare.patientprofile1_id', '=', 'patientprofile1.id')
				->select('caselist.cl_patientid', 'users.name', DB::raw("DATE_FORMAT(patientprofile1.pp_birthday,'%Y-%m-%d') AS birthday"), DB::raw("(CASE patientprofile1.pp_sex WHEN 1 THEN '男' ELSE '女' END) AS sex"), 'patientprofile1.pp_age', 'casecare.cc_mdate', DB::raw("(CASE casecare.cc_edu WHEN 0 THEN '不识字' WHEN 1 THEN '识字' WHEN 2 THEN '小学' WHEN '3' THEN '初中' WHEN '4' THEN '高中' WHEN '5' THEN '大专' ELSE '大学或以上' END) AS edu"), 'patientprofile1.pp_height', 'patientprofile1.pp_weight', 'caselist.cl_bmi', 'caselist.cl_blood_hba1c', 'caselist.cl_ldl', 'caselist.cl_tg', 'caselist.cl_egfr', 'caselist.cl_base_sbp', 'caselist.cl_base_ebp')
				->where('caselist.cl_case_type', '!=', 4)
				->where('caselist.cl_case_type', '!=', 1)
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '>=', DB::raw("'".$ifrom."'"))
				->where(DB::raw('CONCAT(LEFT(caselist.created_at,4),SUBSTRING(caselist.created_at,6,2))'), '<=', DB::raw("'".$ito."'"))
				->groupBy('caselist.cl_patientid')
				->orderBy('caselist.cl_patientid')
				->orderBy('caselist.created_at', 'desc')
				->get();
		}
		$count = $sql;
		return $count;
	}

	public function xlsx($object, $ifrom, $ito)
	{
		$objects = self::$_fname;
		$header = in_array($object, array_keys($objects)) ? $objects[$object] : "other";
		$count = $this->switchcase($object, $ifrom, $ito);
		Excel::create($header, function($excel) use($object, $header, $count, $ifrom, $ito) {
			$excel->sheet('quality', function($sheet) use($object, $header, $count, $ifrom, $ito) {
				$sheet->loadView('quality.xls', array('object' => $object, 'header' => $header, 'count' => $count, 'ifrom' => $ifrom, 'ito' => $ito));
			});
		})->export('xls');
	}

}
