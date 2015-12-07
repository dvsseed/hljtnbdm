<?php namespace App\Http\Controllers\Cases;

use App\Patientprofile;
use App\Caselist;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Event\EventController;

use Illuminate\Http\Request;

class CaseController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$search = urldecode($request->search);
		$category = $request->category;
		if ($search) {
			$categoryList = [
				1 => "cl_patientid",
				2 => "cl_patientname",
				3 => "cl_case_date",
			];
			$field = in_array($category, array_keys($categoryList)) ? $categoryList[$category] : "other";
			$result = Caselist::where($field, 'like', '%' . $search . '%')->orderBy('created_at', 'desc');
		} else {
			$result = Caselist::orderBy('created_at', 'desc');
		}

		$count = $result->count();
		$caselists = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
//		$current_user_id = Auth::user()->id;
		return view('case.index', compact('caselists', 'count', 'search', 'category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($patientid)
	{
		$pps = Patientprofile::where('pp_patientid', '=', $patientid)->first();
		if (is_null($pps)) {
			$err_msg = "患者资料不存在!!<br>請先建立患者资料後才能新增方案資料...";
			return view('case.create', compact('err_msg'));
		} else {
			$today = Carbon::today()->toDateString();
			// $format = $carbon->format('Y-m-d H:i:s');
			$year = Carbon::today()->year;
//		$bsms = BSM::orderBy('bm_order')->get();
//		$areas = Patientprofile::$_area;
//		$doctors = Patientprofile::$_doctor;
//		$sources = Patientprofile::$_source;
//		$occupations = Patientprofile::$_occupation;
//		$languages = Patientprofile::$_language;
//		$patientid = null;
			$patientprofiles = Patientprofile::where('pp_patientid', '=', $patientid)->first();
			$casetypes = array('' => '请选择', '1' => '初诊', '2' => '复诊', '3' => '年度检查', '4' => '一般');
			$err_msg = null;

			EventController::SaveEvent('caselist', 'create(创建)');
//		return view('case.create', compact('year', 'bsms', 'areas', 'doctors', 'sources', 'occupations', 'languages', 'patientid'));
			return view('case.create', compact('err_msg', 'year', 'today', 'casetypes', 'patientprofiles'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$caselist = new Caselist();
		$caselist->pp_id = $request->pp_id;
		$caselist->cl_case_date = $request->cl_case_date;
		$caselist->cl_case_educator = $request->cl_case_educator;
		$caselist->cl_case_type = $request->cl_case_type;
		$caselist->cl_patientname = $request->cl_patientname;
		$caselist->cl_patientid = $request->cl_patientid;
		if($request->cl_case_type == 4) {
			// 一般
			$caselist->cl_base_sbp = $request->_cl_base_sbp;
			$caselist->cl_base_ebp = $request->_cl_base_ebp;
			$caselist->cl_pulse = $request->_cl_pulse;
			$caselist->cl_base_tall = $request->_cl_base_tall;
			$caselist->cl_base_weight = $request->_cl_base_weight;
			$caselist->cl_noweight = $request->_cl_noweight;
			$caselist->cl_ibw = $request->_cl_ibw;
			$caselist->cl_bmi = $request->_cl_bmi;
			$caselist->cl_blood_mne = $request->_cl_blood_mne;
			$caselist->cl_blood_ap = $request->_cl_blood_ap;
			$caselist->cl_blood_acpc = $request->_cl_blood_acpc;
			$caselist->cl_blood_mins = $request->_cl_blood_mins;
			$caselist->cl_smoking = $request->_cl_smoking;
			$caselist->cl_havesmoke = $request->_cl_havesmoke;
			$caselist->cl_quitsmoke = $request->_cl_quitsmoke;
		} else {
			$caselist->cl_base_sbp = $request->cl_base_sbp;
			$caselist->cl_base_ebp = $request->cl_base_ebp;
			$caselist->cl_pulse = $request->cl_pulse;
			$caselist->cl_base_tall = $request->cl_base_tall;
			$caselist->cl_base_weight = $request->cl_base_weight;
			$caselist->cl_noweight = $request->cl_noweight;
			$caselist->cl_ibw = $request->cl_ibw;
			$caselist->cl_bmi = $request->cl_bmi;
			$caselist->cl_waist = $request->cl_waist;
			$caselist->cl_hips = $request->cl_hips;
			$caselist->cl_blood_mne = $request->cl_blood_mne;
			$caselist->cl_blood_ap = $request->cl_blood_ap;
			$caselist->cl_blood_acpc = $request->cl_blood_acpc;
			$caselist->cl_blood_mins = $request->cl_blood_mins;
			$caselist->cl_blood_hba1c = $request->cl_blood_hba1c;
			$caselist->cl_cholesterol = $request->cl_cholesterol;
			$caselist->cl_blood_ldl = $request->cl_blood_ldl;
			$caselist->cl_hdl = $request->cl_hdl;
			$caselist->cl_gpt = $request->cl_gpt;
			$caselist->cl_blood_creat = $request->cl_blood_creat;
			$caselist->cl_uricacid = $request->cl_uricacid;
			$caselist->cl_urine_micro = $request->cl_urine_micro;
			$caselist->cl_upcr = $request->cl_upcr;
			$caselist->cl_urine_routine = $request->cl_urine_routine;
			$caselist->cl_egfr = $request->cl_egfr;
			$caselist->cl_foot_chk_right = ($request->cl_foot_chk_right0 ? "1" : "0") . ($request->cl_foot_chk_right1 ? "1" : "0") . ($request->cl_foot_chk_right2 ? "1" : "0") . ($request->cl_foot_chk_right3 ? "1" : "0") . ($request->cl_foot_chk_right4 ? "1" : "0") . ($request->cl_foot_chk_right5 ? "1" : "0");
			$caselist->cl_foot_chk_left = ($request->cl_foot_chk_left0 ? "1" : "0") . ($request->cl_foot_chk_left1 ? "1" : "0") . ($request->cl_foot_chk_left2 ? "1" : "0") . ($request->cl_foot_chk_left3 ? "1" : "0") . ($request->cl_foot_chk_left4 ? "1" : "0") . ($request->cl_foot_chk_left5 ? "1" : "0");
			$caselist->cl_ulcers = ($request->cl_ulcers ? "1" : "0") . ($request->cl_ulcers_urgent_right ? "1" : "0") . ($request->cl_ulcers_urgent_left ? "1" : "0") . ($request->cl_ulcers_slow_right ? "1" : "0") . ($request->cl_ulcers_slow_left ? "1" : "0");
			$caselist->cl_complications = ($request->cl_complications0 ? "1" : "0") . ($request->cl_complications1 ? "1" : "0") . ($request->cl_complications2 ? "1" : "0");
			$caselist->cl_complications_stage = $request->cl_complications_stage;
			$caselist->cl_complications_other = $request->cl_complications_other;
			$caselist->cl_intermittentpain = ($request->cl_intermittentpain ? "1" : "0") . ($request->cl_intermittentpain_right ? "1" : "0") . ($request->cl_intermittentpain_left ? "1" : "0") . ($request->cl_intermittentpain_no ? "1" : "0");
			$caselist->cl_abi = ($request->cl_abi ? "1" : "0") . ($request->cl_abi_right ? "1" : "0") . ($request->cl_abi_left ? "1" : "0");
			$caselist->cl_abi_right_value = $request->cl_abi_right_value;
			$caselist->cl_abi_left_value = $request->cl_abi_left_value;
			$caselist->cl_cavi = ($request->cl_cavi ? "1" : "0") . ($request->cl_cavi_right ? "1" : "0") . ($request->cl_cavi_left ? "1" : "0");
			$caselist->cl_cavi_right_value = $request->cl_cavi_right_value;
			$caselist->cl_cavi_left_value = $request->cl_cavi_left_value;
			$caselist->cl_cavi_rkcavi = $request->cl_cavi_rkcavi;
			$caselist->cl_eye_chk8 = ($request->cl_eye_chk8 ? "1" : "0") . ($request->cl_eye_chk8_right ? "1" : "0") . ($request->cl_eye_chk8_left ? "1" : "0") . ($request->cl_eye_chk8_no ? "1" : "0");
			$caselist->cl_eye_chk8_right_item = $request->cl_eye_chk8_right_item;
			$caselist->cl_eye_chk8_left_item = $request->cl_eye_chk8_left_item;
			$caselist->cl_cataract = ($request->cl_cataract ? "1" : "0") . ($request->cl_cataract_right ? "1" : "0") . ($request->cl_cataract_left ? "1" : "0") . ($request->cl_cataract_no ? "1" : "0");
			$caselist->cl_triglyceride = $request->cl_triglyceride;
			$caselist->cl_ecg = ($request->cl_ecg ? "1" : "0") . ($request->cl_ecg_no ? "1" : "0");
			$caselist->cl_ecg_item = $request->cl_ecg_item;
			$caselist->cl_ecg_other = $request->cl_ecg_other;
			$caselist->cl_coronary_heart = $request->cl_coronary_heart;
			$caselist->cl_coronary_heart_item = $request->cl_coronary_heart_item;
			$caselist->cl_coronary_heart_other = $request->cl_coronary_heart_other;
			$caselist->cl_chh_year = $request->cl_chh_year;
			$caselist->cl_chh_month = $request->cl_chh_month;
			$caselist->cl_stroke = $request->cl_stroke;
			$caselist->cl_stroke_item = $request->cl_stroke_item;
			$caselist->cl_stroke_other = $request->cl_stroke_other;
			$caselist->cl_sh_year = $request->cl_sh_year;
			$caselist->cl_sh_month = $request->cl_sh_month;
			$caselist->cl_blindness = ($request->cl_blindness ? "1" : "0") . ($request->cl_blindness_right ? "1" : "0") . ($request->cl_blindness_left ? "1" : "0");
			$caselist->cl_blindness_right_item = $request->cl_blindness_right_item;
			$caselist->cl_blindness_left_item = $request->cl_blindness_left_item;
			$caselist->cl_bh_year = $request->cl_bh_year;
			$caselist->cl_bh_month = $request->cl_bh_month;
			$caselist->cl_dialysis = $request->cl_dialysis;
			$caselist->cl_dialysis_item = $request->cl_dialysis_item;
			$caselist->cl_dh_year = $request->cl_dh_year;
			$caselist->cl_dh_month = $request->cl_dh_month;
			$caselist->cl_amputation = ($request->cl_amputation ? "1" : "0") . ($request->cl_amputation_right ? "1" : "0") . ($request->cl_amputation_left ? "1" : "0");
			$caselist->cl_amputation_right_item = $request->cl_amputation_right_item;
			$caselist->cl_amputation_left_item = $request->cl_amputation_left_item;
			$caselist->cl_amputation_other = $request->cl_amputation_other;
			$caselist->cl_ah_year = $request->cl_ah_year;
			$caselist->cl_ah_month = $request->cl_ah_month;
			$caselist->cl_medical_treatment = $request->cl_medical_treatment;
			$caselist->cl_medical_treatment_other = $request->cl_medical_treatment_other;
			$caselist->cl_medical_treatment_emergency = $request->cl_medical_treatment_emergency;
			$caselist->cl_drinking = $request->cl_drinking;
			$caselist->cl_drinking_other = $request->cl_drinking_other;
			$caselist->cl_periodontal = $request->cl_periodontal;
			$caselist->cl_masticatory = $request->cl_masticatory;
			$caselist->cl_smoking = $request->cl_smoking;
			$caselist->cl_havesmoke = $request->cl_havesmoke;
			$caselist->cl_quitsmoke = $request->cl_quitsmoke;
		}
		$caselist->save();

		$msg = '方案成功创建。';
		EventController::SaveEvent('caselist', 'store(保存)');
		return redirect()->route('case.index')->with('message', $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$caselist = Caselist::findOrFail($id);
//		$casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
//		$bsms = BSM::orderBy('bm_order')->get();
//		$account = User::findOrFail($caselist->user_id)->account;
//		$areas = Caselist::$_area;
//		$doctors = Caselist::$_doctor;
//		$sources = Caselist::$_source;
//		$occupations = Caselist::$_occupation;
//		$languages = Caselist::$_language;
		$today = Carbon::today()->toDateString();
		$year = Carbon::today()->year;
		$casetypes = array('' => '请选择', '1' => '初诊', '2' => '复诊', '3' => '年度检查', '4' => '一般');

		EventController::SaveEvent('caselist', 'edit(编辑)');
		return view('case.edit', compact('caselist', 'year', 'today', 'casetypes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$caselist = Caselist::findOrFail($id);
		$caselist->cl_case_date = $request->cl_case_date;
		if($request->cl_case_type == 4) {
			// 一般
			$caselist->cl_base_sbp = $request->_cl_base_sbp;
			$caselist->cl_base_ebp = $request->_cl_base_ebp;
			$caselist->cl_pulse = $request->_cl_pulse;
			$caselist->cl_base_tall = $request->_cl_base_tall;
			$caselist->cl_base_weight = $request->_cl_base_weight;
			$caselist->cl_noweight = $request->_cl_noweight;
			$caselist->cl_ibw = $request->_cl_ibw;
			$caselist->cl_bmi = $request->_cl_bmi;
			$caselist->cl_blood_mne = $request->_cl_blood_mne;
			$caselist->cl_blood_ap = $request->_cl_blood_ap;
			$caselist->cl_blood_acpc = $request->_cl_blood_acpc;
			$caselist->cl_blood_mins = $request->_cl_blood_mins;
			$caselist->cl_smoking = $request->_cl_smoking;
			$caselist->cl_havesmoke = $request->_cl_havesmoke;
			$caselist->cl_quitsmoke = $request->_cl_quitsmoke;
		} else {
			$caselist->cl_base_sbp = $request->cl_base_sbp;
			$caselist->cl_base_ebp = $request->cl_base_ebp;
			$caselist->cl_pulse = $request->cl_pulse;
			$caselist->cl_base_tall = $request->cl_base_tall;
			$caselist->cl_base_weight = $request->cl_base_weight;
			$caselist->cl_noweight = $request->cl_noweight;
			$caselist->cl_ibw = $request->cl_ibw;
			$caselist->cl_bmi = $request->cl_bmi;
			$caselist->cl_waist = $request->cl_waist;
			$caselist->cl_hips = $request->cl_hips;
			$caselist->cl_blood_mne = $request->cl_blood_mne;
			$caselist->cl_blood_ap = $request->cl_blood_ap;
			$caselist->cl_blood_acpc = $request->cl_blood_acpc;
			$caselist->cl_blood_mins = $request->cl_blood_mins;
			$caselist->cl_blood_hba1c = $request->cl_blood_hba1c;
			$caselist->cl_cholesterol = $request->cl_cholesterol;
			$caselist->cl_blood_ldl = $request->cl_blood_ldl;
			$caselist->cl_hdl = $request->cl_hdl;
			$caselist->cl_gpt = $request->cl_gpt;
			$caselist->cl_blood_creat = $request->cl_blood_creat;
			$caselist->cl_uricacid = $request->cl_uricacid;
			$caselist->cl_urine_micro = $request->cl_urine_micro;
			$caselist->cl_upcr = $request->cl_upcr;
			$caselist->cl_urine_routine = $request->cl_urine_routine;
			$caselist->cl_egfr = $request->cl_egfr;
			$caselist->cl_foot_chk_right = ($request->cl_foot_chk_right0 ? "1" : "0") . ($request->cl_foot_chk_right1 ? "1" : "0") . ($request->cl_foot_chk_right2 ? "1" : "0") . ($request->cl_foot_chk_right3 ? "1" : "0") . ($request->cl_foot_chk_right4 ? "1" : "0") . ($request->cl_foot_chk_right5 ? "1" : "0");
			$caselist->cl_foot_chk_left = ($request->cl_foot_chk_left0 ? "1" : "0") . ($request->cl_foot_chk_left1 ? "1" : "0") . ($request->cl_foot_chk_left2 ? "1" : "0") . ($request->cl_foot_chk_left3 ? "1" : "0") . ($request->cl_foot_chk_left4 ? "1" : "0") . ($request->cl_foot_chk_left5 ? "1" : "0");
			$caselist->cl_ulcers = ($request->cl_ulcers ? "1" : "0") . ($request->cl_ulcers_urgent_right ? "1" : "0") . ($request->cl_ulcers_urgent_left ? "1" : "0") . ($request->cl_ulcers_slow_right ? "1" : "0") . ($request->cl_ulcers_slow_left ? "1" : "0");
			$caselist->cl_complications = ($request->cl_complications0 ? "1" : "0") . ($request->cl_complications1 ? "1" : "0") . ($request->cl_complications2 ? "1" : "0");
			$caselist->cl_complications_stage = $request->cl_complications_stage;
			$caselist->cl_complications_other = $request->cl_complications_other;
			$caselist->cl_intermittentpain = ($request->cl_intermittentpain ? "1" : "0") . ($request->cl_intermittentpain_right ? "1" : "0") . ($request->cl_intermittentpain_left ? "1" : "0") . ($request->cl_intermittentpain_no ? "1" : "0");
			$caselist->cl_abi = ($request->cl_abi ? "1" : "0") . ($request->cl_abi_right ? "1" : "0") . ($request->cl_abi_left ? "1" : "0");
			$caselist->cl_abi_right_value = $request->cl_abi_right_value;
			$caselist->cl_abi_left_value = $request->cl_abi_left_value;
			$caselist->cl_cavi = ($request->cl_cavi ? "1" : "0") . ($request->cl_cavi_right ? "1" : "0") . ($request->cl_cavi_left ? "1" : "0");
			$caselist->cl_cavi_right_value = $request->cl_cavi_right_value;
			$caselist->cl_cavi_left_value = $request->cl_cavi_left_value;
			$caselist->cl_cavi_rkcavi = $request->cl_cavi_rkcavi;
			$caselist->cl_eye_chk8 = ($request->cl_eye_chk8 ? "1" : "0") . ($request->cl_eye_chk8_right ? "1" : "0") . ($request->cl_eye_chk8_left ? "1" : "0") . ($request->cl_eye_chk8_no ? "1" : "0");
			$caselist->cl_eye_chk8_right_item = $request->cl_eye_chk8_right_item;
			$caselist->cl_eye_chk8_left_item = $request->cl_eye_chk8_left_item;
			$caselist->cl_cataract = ($request->cl_cataract ? "1" : "0") . ($request->cl_cataract_right ? "1" : "0") . ($request->cl_cataract_left ? "1" : "0") . ($request->cl_cataract_no ? "1" : "0");
			$caselist->cl_triglyceride = $request->cl_triglyceride;
			$caselist->cl_ecg = ($request->cl_ecg ? "1" : "0") . ($request->cl_ecg_no ? "1" : "0");
			$caselist->cl_ecg_item = $request->cl_ecg_item;
			$caselist->cl_ecg_other = $request->cl_ecg_other;
			$caselist->cl_coronary_heart = $request->cl_coronary_heart;
			$caselist->cl_coronary_heart_item = $request->cl_coronary_heart_item;
			$caselist->cl_coronary_heart_other = $request->cl_coronary_heart_other;
			$caselist->cl_chh_year = $request->cl_chh_year;
			$caselist->cl_chh_month = $request->cl_chh_month;
			$caselist->cl_stroke = $request->cl_stroke;
			$caselist->cl_stroke_item = $request->cl_stroke_item;
			$caselist->cl_stroke_other = $request->cl_stroke_other;
			$caselist->cl_sh_year = $request->cl_sh_year;
			$caselist->cl_sh_month = $request->cl_sh_month;
			$caselist->cl_blindness = ($request->cl_blindness ? "1" : "0") . ($request->cl_blindness_right ? "1" : "0") . ($request->cl_blindness_left ? "1" : "0");
			$caselist->cl_blindness_right_item = $request->cl_blindness_right_item;
			$caselist->cl_blindness_left_item = $request->cl_blindness_left_item;
			$caselist->cl_bh_year = $request->cl_bh_year;
			$caselist->cl_bh_month = $request->cl_bh_month;
			$caselist->cl_dialysis = $request->cl_dialysis;
			$caselist->cl_dialysis_item = $request->cl_dialysis_item;
			$caselist->cl_dh_year = $request->cl_dh_year;
			$caselist->cl_dh_month = $request->cl_dh_month;
			$caselist->cl_amputation = ($request->cl_amputation ? "1" : "0") . ($request->cl_amputation_right ? "1" : "0") . ($request->cl_amputation_left ? "1" : "0");
			$caselist->cl_amputation_right_item = $request->cl_amputation_right_item;
			$caselist->cl_amputation_left_item = $request->cl_amputation_left_item;
			$caselist->cl_amputation_other = $request->cl_amputation_other;
			$caselist->cl_ah_year = $request->cl_ah_year;
			$caselist->cl_ah_month = $request->cl_ah_month;
			$caselist->cl_medical_treatment = $request->cl_medical_treatment;
			$caselist->cl_medical_treatment_other = $request->cl_medical_treatment_other;
			$caselist->cl_medical_treatment_emergency = $request->cl_medical_treatment_emergency;
			$caselist->cl_drinking = $request->cl_drinking;
			$caselist->cl_drinking_other = $request->cl_drinking_other;
			$caselist->cl_periodontal = $request->cl_periodontal;
			$caselist->cl_masticatory = $request->cl_masticatory;
			$caselist->cl_smoking = $request->cl_smoking;
			$caselist->cl_havesmoke = $request->cl_havesmoke;
			$caselist->cl_quitsmoke = $request->cl_quitsmoke;
		}
		$caselist->save();

		$msg = '方案成功更新。';
		EventController::SaveEvent('caselist', 'update(更新)');
		return redirect()->route('case.index')->with('message', $msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$casecare = Caselist::find($id);
		$casecare->delete();
		$msg = '方案资料成功删除。';
		EventController::SaveEvent('caselist', 'destroy(删除)');
		return redirect()->back()->with('message', $msg);
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function about()
	{
		return view('case.about');
	}

}
