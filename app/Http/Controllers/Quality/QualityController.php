<?php namespace App\Http\Controllers\Quality;

use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QualityController extends Controller {

	// 对象
	public static $_objects = array(
		"" => "请选择", "0" => "新登录::基本资料(总表)", "1" => "新登录::生理与习惯(总表)", "2" => "新登录::品质指标(总表)", "3" => "新登录::并发症(总表)", "4" => "新登录::生理与习惯明细", "5" => "新登录::并发症明细",
		"6" => "新登录::品质指标明细", "7" => "二年内::基本资料(总表)", "8" => "二年内::生理与习惯(总表)", "9" => "二年内::品质指标(总表)", "10" => "二年内::并发症(总表)", "11" => "二年内::生理与习惯明细", "12" => "二年内::并发症明细",
		"13" => "二年内::品质指标明细", "14" => "区间日期::基本资料(总表)", "15" => "区间日期::生理与习惯(总表)", "16" => "区间日期::品质指标(总表)", "17" => "区间日期::并发症(总表)", "18" => "区间日期::生理与习惯明细",
		"19" => "区间日期::并发症明细", "20" => "区间日期::品质指标明细"
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
		if(strlen($fmonth) == 1) $fmonth = str_pad($fmonth, 2, '0', STR_PAD_LEFT);
		$tyear = $request->interval_toyear;
		$tmonth = $request->interval_tomonth;
		if(strlen($tmonth) == 1) $tmonth = str_pad($tmonth, 2, '0', STR_PAD_LEFT);



		switch ($object) {
			case 0:
				$count = $this->list0();
				break;
			case 1:
				$count = $this->list1();
				break;
			case 2:
				$count = $this->list2();
				break;
			case 3:
				$count = $this->list3();
				break;
			case 4:
				$count = $this->list4();
				break;
			case 5:
				$count = $this->list5();
				break;
			case 6:
				$count = $this->list6();
				break;
			case 7:
				$count = $this->list7();
				break;
			case 8:
				$count = $this->list8();
				break;
			case 9:
				$count = $this->list9();
				break;
			case 10:
				$count = $this->list10();
				break;
			case 11:
				$count = $this->list11();
				break;
			case 12:
				$count = $this->list12();
				break;
			case 13:
				$count = $this->list13();
				break;
			case 14:
				$count = $this->list14();
				break;
			case 15:
				$count = $this->list15();
				break;
			case 16:
				$count = $this->list16();
				break;
			case 17:
				$count = $this->list17();
				break;
			case 18:
				$count = $this->list18();
				break;
			case 19:
				$count = $this->list19();
				break;
			case 20:
				$count = $this->list20();
				break;
			default:
				break;
		}

		return view('quality.lists', compact('object', 'header', 'count'));
	}

	public function firstdata()
	{
		DB::statement('TRUNCATE TABLE firstdata');
		DB::statement('INSERT INTO firstdata SELECT c.id,c.pp_id,c.user_id,c.cl_patientid,c.cl_case_type,c.cl_bmi,c.cl_waist,c.cl_base_sbp,c.cl_base_ebp,c.cl_drinking,c.cl_drinking_other,c.cl_smoking,c.cl_havesmoke,c.cl_quitsmoke,c.cl_periodontal,c.cl_masticatory,c.cl_complications,c.cl_complications_stage,c.cl_complications_other,c.cl_eye_chk8,c.cl_eye_chk8_right_item,c.cl_eye_chk8_left_item,c.cl_blood_hba1c,c.cl_tg,c.cl_ldl,c.cl_egfr,c.cl_cataract,c.cl_coronary_heart,c.cl_coronary_heart_other,c.cl_chh_year,c.cl_chh_month,c.cl_stroke,c.cl_stroke_item,c.cl_stroke_other,c.cl_sh_year,c.cl_sh_month,c.cl_blindness,c.cl_blindness_right_item,c.cl_blindness_left_item,c.cl_bh_year,c.cl_bh_month,c.cl_dialysis,c.cl_dialysis_item,c.cl_dh_year,c.cl_dh_month,c.cl_amputation,c.cl_amputation_right_item,c.cl_amputation_left_item,c.cl_ah_year,c.cl_ah_month,c.cl_amputation_other,c.cl_medical_treatment,c.cl_medical_treatment_other,c.cl_medical_treatment_emergency,u.account,u.name,u.pid,p.pp_patientid,p.pp_birthday,p.pp_age,p.pp_sex,p.pp_height,p.pp_weight,p.educator,cc.patientprofile1_id,cc.cc_mdate,cc.cc_edu FROM caselist AS c LEFT JOIN users AS u ON u.id = c.user_id LEFT JOIN patientprofile1 AS p ON p.user_id = c.user_id LEFT JOIN casecare AS cc ON cc.patientprofile1_id = p.id WHERE c.cl_case_type != 4 GROUP BY c.cl_patientid ORDER BY c.cl_patientid, c.created_at');
		$firstdata = DB::select('select * from firstdata');
		return $firstdata;
	}

	public function twoyearsdata()
	{

	}

	public function intervaldata()
	{

	}

	public function loopdata($firstdata, $fcnt)
	{
		$cnt = 0;
		foreach ($firstdata as $first) {
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
					if(substr($first->cl_complications,0,1) == 1) $cnt++;
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

	public function list0()
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
//		$count[0][0] = count($sql);
//		DB::statement('TRUNCATE TABLE firstdata');
//		DB::statement('INSERT INTO firstdata SELECT c.id,c.pp_id,c.user_id,c.cl_patientid,c.cl_case_type,c.cl_bmi,c.cl_waist,c.cl_base_sbp,c.cl_base_ebp,c.cl_drinking,c.cl_drinking_other,c.cl_smoking,c.cl_havesmoke,c.cl_quitsmoke,c.cl_periodontal,c.cl_masticatory,c.cl_complications,c.cl_complications_stage,c.cl_complications_other,c.cl_eye_chk8,c.cl_eye_chk8_right_item,c.cl_eye_chk8_left_item,c.cl_blood_hba1c,c.cl_tg,c.cl_ldl,c.cl_egfr,c.cl_cataract,c.cl_coronary_heart,c.cl_coronary_heart_other,c.cl_chh_year,c.cl_chh_month,c.cl_stroke,c.cl_stroke_item,c.cl_stroke_other,c.cl_sh_year,c.cl_sh_month,c.cl_blindness,c.cl_blindness_right_item,c.cl_blindness_left_item,c.cl_bh_year,c.cl_bh_month,c.cl_dialysis,c.cl_dialysis_item,c.cl_dh_year,c.cl_dh_month,c.cl_amputation,c.cl_amputation_right_item,c.cl_amputation_left_item,c.cl_ah_year,c.cl_ah_month,c.cl_amputation_other,c.cl_medical_treatment,c.cl_medical_treatment_other,c.cl_medical_treatment_emergency,u.account,u.name,u.pid,p.pp_patientid,p.pp_birthday,p.pp_age,p.pp_sex,p.pp_height,p.pp_weight,p.educator,cc.patientprofile1_id,cc.cc_mdate,cc.cc_edu FROM caselist AS c LEFT JOIN users AS u ON u.id = c.user_id LEFT JOIN patientprofile1 AS p ON p.user_id = c.user_id LEFT JOIN casecare AS cc ON cc.patientprofile1_id = p.id WHERE c.cl_case_type != 4 GROUP BY c.cl_patientid ORDER BY c.cl_patientid, c.created_at');
		$firstdata = $this->firstdata();
		$count[0][0] = count($firstdata);
		// 性别-男
//			->where(DB::raw('MOD(SUBSTRING(caselist.cl_patientid,17,1),2)'), 1)
		$count[0][1] = $this->loopdata($firstdata, "c01");
		// 性别-女
//			->where(DB::raw('MOD(SUBSTRING(caselist.cl_patientid,17,1),2)'), 0)
		$count[0][2] = $this->loopdata($firstdata, "c02");
		// 年龄 <15
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 15)
		$count[1][1] = $this->loopdata($firstdata, "c11");
		// 年龄 ≥15~<20
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 15)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 20)
		$count[1][2] = $this->loopdata($firstdata, "c12");
		// 年龄 ≥20~<25
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 20)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 25)
		$count[1][3] = $this->loopdata($firstdata, "c13");
		// 年龄 ≥25~<30
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 25)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 30)
		$count[1][4] = $this->loopdata($firstdata, "c14");
		// 年龄 ≥30~<35
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 30)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 35)
		$count[1][5] = $this->loopdata($firstdata, "c15");
		// 年龄 ≥35~<40
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 35)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 40)
		$count[1][6] = $this->loopdata($firstdata, "c16");
		// 年龄 ≥40~<45
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 40)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 45)
		$count[1][7] = $this->loopdata($firstdata, "c17");
		// 年龄 ≥45~<50
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 45)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 50)
		$count[1][8] = $this->loopdata($firstdata, "c18");
		// 年龄 ≥50~<55
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 50)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 55)
		$count[1][9] = $this->loopdata($firstdata, "c19");
		// 年龄 ≥55~<60
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 55)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 60)
		$count[1][10] = $this->loopdata($firstdata, "c110");
		// 年龄 ≥60~<65
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 60)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 65)
		$count[1][11] = $this->loopdata($firstdata, "c111");
		// 年龄 ≥65~<70
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 65)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 70)
		$count[1][12] = $this->loopdata($firstdata, "c112");
		// 年龄 ≥70~<75
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 70)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 75)
		$count[1][13] = $this->loopdata($firstdata, "c113");
		// 年龄 ≥75~<80
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 75)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 80)
		$count[1][14] = $this->loopdata($firstdata, "c114");
		// 年龄 ≥80~<85
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 80)
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '<', 85)
		$count[1][15] = $this->loopdata($firstdata, "c115");
		// 年龄 ≥85
//			->where(DB::raw('SUBSTRING(caselist.cl_patientid,7,4)-1911'), '>=', 85)
		$count[1][16] = $this->loopdata($firstdata, "c116");
		// 罹病年 <1年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 1)
		$count[2][1] = $this->loopdata($firstdata, "c21");
		// 罹病年 ≥1~<5年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 1)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 5)
		$count[2][2] = $this->loopdata($firstdata, "c22");
		// 罹病年 ≥5~<10年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 5)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 10)
		$count[2][3] = $this->loopdata($firstdata, "c23");
		// 罹病年 ≥10~<15年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 10)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 15)
		$count[2][4] = $this->loopdata($firstdata, "c24");
		// 罹病年 ≥15~<20年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 15)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 20)
		$count[2][5] = $this->loopdata($firstdata, "c25");
		// 罹病年 ≥20~<25年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 20)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 25)
		$count[2][6] = $this->loopdata($firstdata, "c26");
		// 罹病年 ≥25~<30年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 25)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 30)
		$count[2][7] = $this->loopdata($firstdata, "c27");
		// 罹病年 ≥30~<35年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 30)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 35)
		$count[2][8] = $this->loopdata($firstdata, "c28");
		// 罹病年 ≥35~<40年
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 35)
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '<', 40)
		$count[2][9] = $this->loopdata($firstdata, "c29");
		// 罹病年 ≥40
//			->where(DB::raw('YEAR(CURDATE())-casecare.cc_mdate'), '>=', 40)
		$count[2][10] = $this->loopdata($firstdata, "c210");
		// 教育程度 不识字
//			->where('caselist.cl_case_type', '!=', 4)
		$count[3][1] = $this->loopdata($firstdata, "c31");
		// 教育程度 识字
//			->where('casecare.cc_edu', 1)
		$count[3][2] = $this->loopdata($firstdata, "c32");
		// 教育程度 小学
//			->where('casecare.cc_edu', 2)
		$count[3][3] = $this->loopdata($firstdata, "c33");
		// 教育程度 初中
//			->where('casecare.cc_edu', 3)
		$count[3][4] = $this->loopdata($firstdata, "c34");
		// 教育程度 高中
//			->where('casecare.cc_edu', 4)
		$count[3][5] = $this->loopdata($firstdata, "c35");
		// 教育程度 大专
//			->where('casecare.cc_edu', 5)
		$count[3][6] = $this->loopdata($firstdata, "c36");
		// 教育程度 大学或以上
//			->where('casecare.cc_edu', 6)
		$count[3][7] = $this->loopdata($firstdata, "c37");

		return $count;
	}

	public function list1()
	{
		// BMI-总笔数
		$firstdata = $this->firstdata();
		$count[0][0] = count($firstdata);
		// BMI <18.5
//			->where('caselist.cl_bmi', '<', 18.5)
		$count[0][1] = $this->loopdata($firstdata, "a01");
		// BMI ≥18.5~<22
//			->where('caselist.cl_bmi', '>=', 18.5)
//			->where('caselist.cl_bmi', '<', 22)
		$count[0][2] = $this->loopdata($firstdata, "a02");
		// BMI ≥22~<23
//			->where('caselist.cl_bmi', '>=', 22)
//			->where('caselist.cl_bmi', '<', 23)
		$count[0][3] = $this->loopdata($firstdata, "a03");
		// BMI ≥23~<24
//			->where('caselist.cl_bmi', '>=', 23)
//			->where('caselist.cl_bmi', '<', 24)
		$count[0][4] = $this->loopdata($firstdata, "a04");
		// BMI ≥24~<27
//			->where('caselist.cl_bmi', '>=', 24)
//			->where('caselist.cl_bmi', '<', 27)
		$count[0][5] = $this->loopdata($firstdata, "a05");
		// BMI ≥27~<30
//			->where('caselist.cl_bmi', '>=', 27)
//			->where('caselist.cl_bmi', '<', 30)
		$count[0][6] = $this->loopdata($firstdata, "a06");
		// BMI ≥30~<35
//			->where('caselist.cl_bmi', '>=', 30)
//			->where('caselist.cl_bmi', '<', 35)
		$count[0][7] = $this->loopdata($firstdata, "a07");
		// BMI ≥35~<40
//			->where('caselist.cl_bmi', '>=', 35)
//			->where('caselist.cl_bmi', '<', 40)
		$count[0][8] = $this->loopdata($firstdata, "a08");
		// BMI ≥40
//			->where('caselist.cl_bmi', '>=', 40)
		$count[0][9] = $this->loopdata($firstdata, "a09");
		// 腰围 男性<90
//			->where('patientprofile1.pp_sex', 1)
//			->where('caselist.cl_waist', '<', 90)
		$count[1][1] = $this->loopdata($firstdata, "a11");
		// 腰围 女性<80
//			->where('patientprofile1.pp_sex', 0)
//			->where('caselist.cl_waist', '<', 80)
		$count[1][2] = $this->loopdata($firstdata, "a12");
		// 吸烟
//			->where('caselist.cl_smoking', 1)
		$count[2][1] = $this->loopdata($firstdata, "a21");
		// 饮酒
//			->where(DB::raw('IFNULL(caselist.cl_drinking_other, 0)'), '>', 0)
		$count[3][1] = $this->loopdata($firstdata, "a31");
		// 牙周病
//			->where(DB::raw('IFNULL(caselist.cl_periodontal, 0)'), 1)
		$count[4][1] = $this->loopdata($firstdata, "a41");
		// 咀嚼
//			->where(DB::raw('IFNULL(caselist.cl_masticatory, 0)'), 1)
		$count[5][1] = $this->loopdata($firstdata, "a51");
		return $count;
	}

	public function list2()
	{
		// A1C-总笔数
		$firstdata = $this->firstdata();
		$count[0][0] = count($firstdata);
		// A1C <6.0
//			->where('caselist.cl_blood_hba1c', '<', 6)
		$count[0][1] = $this->loopdata($firstdata, "b01");
		// A1C ≥6.0~<6.5
//			->where('caselist.cl_blood_hba1c', '>=', 6)
//			->where('caselist.cl_blood_hba1c', '<', 6.5)
		$count[0][2] = $this->loopdata($firstdata, "b02");
		// A1C ≥6.5~<7.0
//			->where('caselist.cl_blood_hba1c', '>=', 6.5)
//			->where('caselist.cl_blood_hba1c', '<', 7)
		$count[0][3] = $this->loopdata($firstdata, "b03");
		// A1C ≥7.0~<7.5
//			->where('caselist.cl_blood_hba1c', '>=', 7)
//			->where('caselist.cl_blood_hba1c', '<', 7.5)
		$count[0][4] = $this->loopdata($firstdata, "b04");
		// A1C ≥7.5~<8.0
//			->where('caselist.cl_blood_hba1c', '>=', 7.5)
//			->where('caselist.cl_blood_hba1c', '<', 8)
		$count[0][5] = $this->loopdata($firstdata, "b05");
		// A1C ≥8.0~<8.5
//			->where('caselist.cl_blood_hba1c', '>=', 8)
//			->where('caselist.cl_blood_hba1c', '<', 8.5)
		$count[0][6] = $this->loopdata($firstdata, "b06");
		// A1C ≥8.5~<9.0
//			->where('caselist.cl_blood_hba1c', '>=', 8.5)
//			->where('caselist.cl_blood_hba1c', '<', 9)
		$count[0][7] = $this->loopdata($firstdata, "b07");
		// A1C ≥9.0~<9.5
//			->where('caselist.cl_blood_hba1c', '>=', 9)
//			->where('caselist.cl_blood_hba1c', '<', 9.5)
		$count[0][8] = $this->loopdata($firstdata, "b08");
		// A1C ≥9.5~<10.0
//			->where('caselist.cl_blood_hba1c', '>=', 9.5)
//			->where('caselist.cl_blood_hba1c', '<', 10)
		$count[0][9] = $this->loopdata($firstdata, "b09");
		// A1C ≥10.0
//			->where('caselist.cl_blood_hba1c', '>=', 10)
		$count[0][10] = $this->loopdata($firstdata, "b010");
		// LDL <1.81
//			->where('caselist.cl_ldl', '<', 1.81)
		$count[1][1] = $this->loopdata($firstdata, "b11");
		// LDL ≥1.81~<2.59
//			->where('caselist.cl_ldl', '>=', 1.81)
//			->where('caselist.cl_ldl', '<', 2.59)
		$count[1][2] = $this->loopdata($firstdata, "b12");
		// LDL ≥2.59~<3.37
//			->where('caselist.cl_ldl', '>=', 2.59)
//			->where('caselist.cl_ldl', '<', 3.37)
		$count[1][3] = $this->loopdata($firstdata, "b13");
		// LDL ≥3.37
//			->where('caselist.cl_ldl', '>=', 3.37)
		$count[1][4] = $this->loopdata($firstdata, "b14");
		// TG <1.70
//			->where('caselist.cl_tg', '<', 1.7)
		$count[2][1] = $this->loopdata($firstdata, "b21");
		// TG ≥1.70~<2.26
//			->where('caselist.cl_tg', '>=', 1.7)
//			->where('caselist.cl_tg', '<', 2.26)
		$count[2][2] = $this->loopdata($firstdata, "b22");
		// TG ≥2.26~<5.65
//			->where('caselist.cl_tg', '>=', 2.26)
//			->where('caselist.cl_tg', '<', 5.65)
		$count[2][3] = $this->loopdata($firstdata, "b23");
		// TG ≥5.65
//			->where('caselist.cl_tg', '>=', 5.65)
		$count[2][4] = $this->loopdata($firstdata, "b24");
		// eGFR ≥90
//			->where('caselist.cl_egfr', '>=', 90)
		$count[3][1] = $this->loopdata($firstdata, "b31");
		// eGFR <90~≥60
//			->where('caselist.cl_egfr', '>=', 60)
//			->where('caselist.cl_egfr', '<', 90)
		$count[3][2] = $this->loopdata($firstdata, "b32");
		// eGFR <60~≥45
//			->where('caselist.cl_egfr', '>=', 45)
//			->where('caselist.cl_egfr', '<', 60)
		$count[3][3] = $this->loopdata($firstdata, "b33");
		// eGFR <45~≥30
//			->where('caselist.cl_egfr', '>=', 30)
//			->where('caselist.cl_egfr', '<', 45)
		$count[3][4] = $this->loopdata($firstdata, "b34");
		// eGFR <30~≥15
//			->where('caselist.cl_egfr', '>=', 15)
//			->where('caselist.cl_egfr', '<', 30)
		$count[3][5] = $this->loopdata($firstdata, "b35");
		// eGFR <15
//			->where('caselist.cl_egfr', '<', 15)
		$count[3][6] = $this->loopdata($firstdata, "b36");
		// BP <120/80
//			->where('caselist.cl_base_sbp', '<', 120)
//			->where('caselist.cl_base_ebp', '<', 80)
		$count[4][1] = $this->loopdata($firstdata, "b41");
		// BP <130/80
//			->where('caselist.cl_base_sbp', '<', 130)
//			->where('caselist.cl_base_ebp', '<', 80)
		$count[4][2] = $this->loopdata($firstdata, "b42");
		// BP <140/80
//			->where('caselist.cl_base_sbp', '<', 140)
//			->where('caselist.cl_base_ebp', '<', 80)
		$count[4][3] = $this->loopdata($firstdata, "b43");
		// BP <150/90
//			->where('caselist.cl_base_sbp', '<', 150)
//			->where('caselist.cl_base_ebp', '<', 90)
		$count[4][4] = $this->loopdata($firstdata, "b44");

		return $count;
	}

	public function list3()
	{
		// 肾病变-总笔数
		$firstdata = $this->firstdata();
		$count[0][0] = count($firstdata);
		// 肾病变 无
//			->where(DB::raw('LEFT(caselist.cl_complications,1)'), "1")
		$count[0][1] = $this->loopdata($firstdata, "d01");
		// 肾病变 stage1
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 1)
		$count[0][2] = $this->loopdata($firstdata, "d02");
		// 肾病变 stage2
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 2)
		$count[0][3] = $this->loopdata($firstdata, "d03");
		// 肾病变 stage3a
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 3)
		$count[0][4] = $this->loopdata($firstdata, "d04");
		// 肾病变 stage3b
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 4)
		$count[0][5] = $this->loopdata($firstdata, "d05");
		// 肾病变 stage4
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 5)
		$count[0][6] = $this->loopdata($firstdata, "d06");
		// 肾病变 stage5
//			->where(DB::raw('IFNULL(caselist.cl_complications_stage,0)'), 6)
		$count[0][7] = $this->loopdata($firstdata, "d07");
		// 周边血管病变 有
//			->where(DB::raw('SUBSTRING(caselist.cl_complications,3,1)'), "1")
		$count[1][1] = $this->loopdata($firstdata, "d11");
		// 神经病变 有
//			->where(DB::raw('SUBSTRING(caselist.cl_complications,2,1)'), "1")
		$count[2][1] = $this->loopdata($firstdata, "d21");
		// 视网膜病变 有
//			->where(DB::raw('SUBSTRING(caselist.cl_eye_chk8,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_eye_chk8,3,1)'), "1")
//			->orWhere('caselist.cl_eye_chk8_right_item', ">=", 1)
//			->orWhere('caselist.cl_eye_chk8_left_item', ">=", 1)
		$count[3][1] = $this->loopdata($firstdata, "d31");
		// 白内障 有
//			->where(DB::raw('SUBSTRING(caselist.cl_cataract,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_cataract,3,1)'), "1")
		$count[4][1] = $this->loopdata($firstdata, "d41");
		// 冠心病 无
//			->where('caselist.cl_coronary_heart', 1)
		$count[5][1] = $this->loopdata($firstdata, "d51");
		// 冠心病 有，发生时间<1年
//			->where(DB::raw('caselist.cl_coronary_heart_other IS NOT NULL'))
//			->where('caselist.cl_chh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_chh_year'), 0)
//			->where('caselist.cl_chh_month', '!=', -1)
//			->where(DB::raw('MONTH(CURDATE())-caselist.cl_chh_month'), '>=', 1)
		$count[5][2] = $this->loopdata($firstdata, "d52");
		// 冠心病 有，发生时间≥1年
//			->where(DB::raw('caselist.cl_coronary_heart_other IS NOT NULL'))
//			->where('caselist.cl_chh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_chh_year'), '>=', 1)
		$count[5][3] = $this->loopdata($firstdata, "d53");
		// 脑中风 无
//			->where('caselist.cl_stroke', 1)
		$count[6][1] = $this->loopdata($firstdata, "d61");
		// 脑中风 有，发生时间<1年
//			->where(DB::raw('caselist.cl_stroke_other IS NOT NULL'))
//			->orWhere('caselist.cl_stroke_item', '>=', 1)
//			->where('caselist.cl_sh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_sh_year'), 0)
//			->where('caselist.cl_sh_month', '!=', -1)
//			->where(DB::raw('MONTH(CURDATE())-caselist.cl_sh_month'), '>=', 1)
		$count[6][2] = $this->loopdata($firstdata, "d62");
		// 脑中风 有，发生时间≥1年
//			->where(DB::raw('caselist.cl_stroke_other IS NOT NULL'))
//			->orWhere('caselist.cl_stroke_item', '>=', 1)
//			->where('caselist.cl_sh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_sh_year'), '>=', 1)
		$count[6][3] = $this->loopdata($firstdata, "d63");
		// 失明 无
//			->where(DB::raw('LEFT(caselist.cl_blindness,1)'), "1")
		$count[7][1] = $this->loopdata($firstdata, "d71");
		// 失明 有，发生时间<1年
//			->where(DB::raw('SUBSTRING(caselist.cl_blindness,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_blindness,3,1)'), "1")
//			->orWhere('caselist.cl_blindness_right_item', '>=', 1)
//			->orWhere('caselist.cl_blindness_left_item', '>=', 1)
//			->where('caselist.cl_bh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_bh_year'), 0)
//			->where('caselist.cl_bh_month', '!=', -1)
//			->where(DB::raw('MONTH(CURDATE())-caselist.cl_bh_month'), '>=', 1)
		$count[7][2] = $this->loopdata($firstdata, "d72");
		// 失明 有，发生时间≥1年
//			->where(DB::raw('SUBSTRING(caselist.cl_blindness,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_blindness,3,1)'), "1")
//			->orWhere('caselist.cl_blindness_right_item', '>=', 1)
//			->orWhere('caselist.cl_blindness_left_item', '>=', 1)
//			->where('caselist.cl_bh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_bh_year'), '>=', 1)
		$count[7][3] = $this->loopdata($firstdata, "d73");
		// 透析 无
//			->where('caselist.cl_dialysis', 1)
		$count[8][1] = $this->loopdata($firstdata, "d81");
		// 透析 有，发生时间<1年
//			->where('caselist.cl_dialysis_item', '>=', 1)
//			->where('caselist.cl_dh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_dh_year'), 0)
//			->where('caselist.cl_dh_month', '!=', -1)
//			->where(DB::raw('MONTH(CURDATE())-caselist.cl_dh_month'), '>=', 1)
		$count[8][2] = $this->loopdata($firstdata, "d82");
		// 透析 有，发生时间≥1年
//			->where('caselist.cl_dialysis_item', '>=', 1)
//			->where('caselist.cl_dh_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_dh_year'), '>=', 1)
		$count[8][3] = $this->loopdata($firstdata, "d83");
		// 下肢截肢 无
//			->where(DB::raw('LEFT(caselist.cl_amputation,1)'), "1")
		$count[9][1] = $this->loopdata($firstdata, "d91");
		// 下肢截肢 有，发生时间<1年
//			->where(DB::raw('SUBSTRING(caselist.cl_amputation,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_amputation,3,1)'), "1")
//			->orWhere(DB::raw('caselist.cl_amputation_other IS NOT NULL'))
//			->orWhere('caselist.cl_amputation_right_item', '>=', 1)
//			->orWhere('caselist.cl_amputation_left_item', '>=', 1)
//			->where('caselist.cl_ah_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_ah_year'), 0)
//			->where('caselist.cl_ah_month', '!=', -1)
//			->where(DB::raw('MONTH(CURDATE())-caselist.cl_ah_month'), '>=', 1)
		$count[9][2] = $this->loopdata($firstdata, "d92");
		// 下肢截肢 有，发生时间≥1年
//			->where(DB::raw('SUBSTRING(caselist.cl_amputation,2,1)'), "1")
//			->orWhere(DB::raw('SUBSTRING(caselist.cl_amputation,3,1)'), "1")
//			->orWhere(DB::raw('caselist.cl_amputation_other IS NOT NULL'))
//			->orWhere('caselist.cl_amputation_right_item', '>=', 1)
//			->orWhere('caselist.cl_amputation_left_item', '>=', 1)
//			->where('caselist.cl_ah_year', '!=', -1)
//			->where(DB::raw('YEAR(CURDATE())-caselist.cl_ah_year'), '>=', 1)
		$count[9][3] = $this->loopdata($firstdata, "d93");
		// 高低血糖就医 有
//			->where(DB::raw('caselist.cl_medical_treatment_other IS NOT NULL'))
//			->orWhere('caselist.cl_medical_treatment_emergency', '>=', 1)
		$count[10][1] = $this->loopdata($firstdata, "d101");

		return $count;
	}

	public function list4()
	{
		// 新登錄_生理與習慣明細
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
		$count = $sql;
		return $count;
	}

	public function list5()
	{
		// 新登錄_併發症明細
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
		$count = $sql;
		return $count;
	}

	public function list6()
	{
		// 新登錄_品質指標明細
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
		$count = $sql;
		return $count;
	}

	public function list7()
	{
	}
	public function list8()
	{
	}
	public function list9()
	{
	}
	public function list10()
	{
	}
	public function list11()
	{
	}
	public function list12()
	{
	}
	public function list13()
	{
	}
	public function list14()
	{
		// 区间日期::基本资料(总表)

	}
	public function list15()
	{
	}
	public function list16()
	{
	}
	public function list17()
	{
	}
	public function list18()
	{
	}
	public function list19()
	{
	}
	public function list20()
	{
	}

	}
