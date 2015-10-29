<?php namespace App\Http\Controllers\Patient;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Patientprofile;
use Illuminate\Http\Request;

use App\Model\Pdata\HospitalNo;
use Auth;

class PatientprofileController extends Controller {

        public function __construct()
       	{
                $this->middleware('auth');
		// \Debugbar::disable();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$user = Auth::user();

		if ($request->forget=="1")
		{
			Session::forget('search');
			Session::forget('category');
			$search = null;
			$category = null;
		} else {
			if (Session::has('search'))
			{
				$search = Session::get('search');
			} else {
				$search = $request->search;
				Session::put('search', $search);
			}
                	if (Session::has('category'))
                	{
                        	$category = Session::get('category');
                	} else {
                        	$category = $request->category;
                        	Session::put('category', $category);
                	}
		}

	        if (count($search) >= 1)
	        {
	           switch ($category) {
	             case 1:
	               $field = 'pp_name';
	               break;
	             case 2:
	               $field = 'pp_patientid';
	               break;
	             case 3:
	               $field = 'pp_personid';
	               break;
	           }
	           $result = Patientprofile::where($field, 'like', '%' . $search . '%')->orderBy('created_at', 'desc');
	        }
	        else
	           $result = Patientprofile::orderBy('created_at', 'desc');

		$count = $result->count();

		$patientprofiles = $result->paginate(10);

		$hiss = DB::connection('oracle')->select('select * from pub_class_office'); // where bmdm=2002');

		// return view('patient.index', compact('patientprofiles', 'count', 'hiss'));
                return view('patient.index', compact('patientprofiles', 'count', 'hiss', 'search', 'category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$carbon = Carbon::today();
		// $format = $carbon->format('Y-m-d H:i:s');
		$year = $carbon->year;

		$bsms = BSM::orderBy('bm_order')->get();

		EventController::SaveEvent('patientprofile', 'create(创建)');
		return view('patient.create', compact('year', 'bsms'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
                $this->validate($request, Patientprofile::rules());

		// patientprofile1
		$patientprofile = new Patientprofile();
                $patientprofile->pp_patientid = trim($request->pp_patientid);
                $patientprofile->pp_personid = trim($request->pp_personid);
                $patientprofile->pp_name = $request->pp_name;
                $patientprofile->pp_birthday = $request->pp_birthday;
                $patientprofile->pp_age = $request->pp_age;
                $patientprofile->pp_sex = $request->pp_sex;
                $patientprofile->pp_height = $request->pp_height;
                $patientprofile->pp_weight = $request->pp_weight;
                $patientprofile->pp_tel1 = $request->pp_tel1;
                $patientprofile->pp_tel2 = $request->pp_tel2;
                $patientprofile->pp_mobile1 = $request->pp_mobile1;
                $patientprofile->pp_mobile2 = $request->pp_mobile2;
                $patientprofile->pp_area = $request->pp_area;
                $patientprofile->pp_doctor = $request->pp_doctor;
                $patientprofile->pp_remark = $request->pp_remark;
                $patientprofile->pp_source = $request->pp_source;
                $patientprofile->pp_occupation = $request->pp_occupation;
                $patientprofile->pp_address = $request->pp_address;
                $patientprofile->pp_email = $request->pp_email;
		$patientprofile->save();

		$this->validate($request, CaseCare::rules());

		// casecare
		$casecare = new CaseCare();
		$casecare->patientprofile1_id = $patientprofile->id;
		$casecare->cc_patientid = trim($request->pp_patientid);
		$casecare->cc_contactor = $request->cc_contactor;
                $casecare->cc_contactor = $request->cc_contactor;
                $casecare->cc_contactor_tel = $request->cc_contactor_tel;
                $casecare->cc_language = $request->cc_language;
                $casecare->cc_mdate = $request->cc_mdate;
                $casecare->cc_mdatem = $request->cc_mdatem;
                $casecare->cc_type = $request->cc_type;
                $casecare->cc_ibw = $request->cc_ibw;
                $casecare->cc_bmi = $request->cc_bmi;
                $casecare->cc_waist = $request->cc_waist;
                $casecare->cc_butt = $request->cc_butt;
		if ($request->cc_status)
		{
			$casecare->cc_status = ($request->cc_status_c1 ? "1" : "0").($request->cc_status_c2 ? "1" : "0").($request->cc_status_c3 ? "1" : "0").($request->cc_status_c4 ? "1" : "0").($request->cc_status_c5 ? "1" : "0");
		} else {
	                $casecare->cc_status = "";
        	        $casecare->cc_status_other = "";
		}
                $casecare->cc_drink = $request->cc_drink;
                $casecare->cc_wine = $request->cc_wine;
                $casecare->cc_wineq = $request->cc_wineq;
                $casecare->cc_smoke = (($request->cc_smoke == 1 && $request->cc_smoke_time > 0) ? $request->cc_smoke_time : $request->cc_smoke);
                $casecare->cc_mh = $request->cc_mh;
                $casecare->cc_fh = $request->cc_fh;
                $casecare->cc_fh_desc = $request->cc_fh_desc;
                $casecare->cc_drug_allergy = $request->cc_drug_allergy;
                $casecare->cc_drug_allergy_name = $request->cc_drug_allergy_name;
                $casecare->cc_activity = $request->cc_activity;
                $casecare->cc_medicaretype = $request->cc_medicaretype;
                $casecare->cc_jobtime = $request->cc_jobtime;
                $casecare->cc_current_use = ($request->cc_current_use0 ? "1" : "0").($request->cc_current_use1 ? "1" : "0").($request->cc_current_use2 ? "1" : "0").($request->cc_current_use3 ? "1" : "0").($request->cc_current_use4 ? "1" : "0").($request->cc_current_use5 ? "1" : "0");
                $casecare->cc_starty = $request->cc_starty;
                $casecare->cc_startm = $request->cc_startm;
		$casecare->cc_hinder = ($request->cc_hinder0 ? "1":"0").($request->cc_hinder1 ? "1" : "0").($request->cc_hinder2 ? "1" : "0").($request->cc_hinder3 ? "1" : "0").($request->cc_hinder4 ? "1" : "0").($request->cc_hinder5 ? "1" : "0").($request->cc_hinder6 ? "1" : "0").($request->cc_hinder7 ? "1" : "0").($request->cc_hinder8 ? "1" : "0").($request->cc_hinder9 ? "1" : "0");
                $casecare->cc_hinder_desc = $request->cc_hinder_desc;
                $casecare->cc_act_time = $request->cc_act_time;
                $casecare->cc_act_kind = $request->cc_act_kind;
                $casecare->cc_edu = $request->cc_edu;
                $casecare->cc_careself = $request->cc_careself;
                $casecare->cc_careself_name = $request->cc_careself_name;
                $casecare->cc_careman = $request->cc_careman;
                $casecare->cc_careman_tel = $request->cc_careman_tel;
                if ($request->cc_usebsm)
                {
                        $casecare->cc_usebsm = $request->cc_usebsm_name;
                }
                $casecare->cc_usebsm_frq = $request->cc_usebsm_frq;
                if ($request->cc_usebsm_frq) { // by month
                        $casecare->cc_usebsm_unit = $request->cc_usebsm_frq_month;
                } else { // by week
                        $casecare->cc_usebsm_unit = $request->cc_usebsm_frq_week;
                }
                $casecare->cc_g6pd = $request->cc_g6pd;
                $casecare->cc_deathdate = $request->cc_deathdate;
                $casecare->cc_deathdatem = $request->cc_deathdatem;
                $casecare->cc_smartphone = $request->cc_smartphone;
                $casecare->cc_wifi3g = $request->cc_wifi3g;
                $casecare->cc_smartphone_family = $request->cc_smartphone_family;
                $casecare->cc_familyupload = $request->cc_familyupload;
                $casecare->cc_uploadtodm = $request->cc_uploadtodm;
                $casecare->cc_appexp = $request->cc_appexp;
                $casecare->cc_lastexam = $request->cc_lastexam;
		$casecare->save();
		$patientprofile->save();

        //create the hospital_no
        while(1){
            $uuid = uniqid('cn_');
            if(HospitalNo::find($uuid) == null){
                break;
            }
        }
        $hospital_no = new HospitalNo();
        $hospital_no -> hospital_no_uuid = $uuid;
        $hospital_no -> patient_user_id = $request->input("pp_personid");
        $hospital_no -> nurse_user_id = Auth::user() -> id;
        $hospital_no -> hospital_no_displayname = substr($request->input("pp_patientid"),0,-6).'xxxxxx';
        $hospital_no -> save();

                // bsm 血糖仪新增
                if ($request->cc_usebsm && $request->cc_usebsm_name==0 && $request->cc_otherbsm)
                {
                        $bsm = new BSM();
                        $bsm->bm_name = $request->cc_otherbsm;
                        $bsm->bm_model = $request->cc_otherbsm;
                        $bsm->save();

                        $casecare = CaseCare::where('patientprofile1_id', '=', $patientprofile->id)->firstOrFail();
                        $casecare->cc_usebsm = $bsm->id;
                        $casecare->save();
                }

		// $this->validate($request, [
		//	'id' => 'required|numeric|unique:users',
		// ]);

		// users
		$user = new User;
		$user->id = trim($request->pp_patientid);
		$user->name = $request->pp_name;
		$user->password = Hash::make($user->id);
		$user->phone = $request->pp_mobile1;
		$user->email = $request->pp_email;
		$user->save();

		EventController::SaveEvent('patientprofile', 'store(保存)');
		return redirect()->route('patient.index')->with('message', '项目成功创建。');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patientprofile = Patientprofile::findOrFail($id);
		$casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
                $carbon = Carbon::today();
                $year = $carbon->year;
                $bsms = BSM::orderBy('bm_order')->get();

		EventController::SaveEvent('patientprofile', 'show(显示)');
		return view('patient.show', compact('patientprofile', 'casecare', 'year', 'bsms'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$patientprofile = Patientprofile::findOrFail($id);
		$casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
                $carbon = Carbon::today();
                $year = $carbon->year;
                $bsms = BSM::orderBy('bm_order')->get();

		EventController::SaveEvent('patientprofile', 'edit(编辑)');
		return view('patient.edit', compact('patientprofile', 'casecare', 'year', 'bsms'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, Patientprofile::updaterules());

		$patientprofile = Patientprofile::findOrFail($id);
                // $patientprofile->pp_patientid = trim($request->pp_patientid);
                // $patientprofile->pp_personid = trim($request->pp_personid);
                $patientprofile->pp_name = $request->pp_name;
                $patientprofile->pp_birthday = $request->pp_birthday;
                $patientprofile->pp_age = $request->pp_age;
                $patientprofile->pp_sex = $request->pp_sex;
                $patientprofile->pp_height = $request->pp_height;
                $patientprofile->pp_weight = $request->pp_weight;
                $patientprofile->pp_tel1 = $request->pp_tel1;
                $patientprofile->pp_tel2 = $request->pp_tel2;
                $patientprofile->pp_mobile1 = $request->pp_mobile1;
                $patientprofile->pp_mobile2 = $request->pp_mobile2;
                $patientprofile->pp_area = $request->pp_area;
                $patientprofile->pp_doctor = $request->pp_doctor;
                $patientprofile->pp_remark = $request->pp_remark;
                $patientprofile->pp_source = $request->pp_source;
                $patientprofile->pp_occupation = $request->pp_occupation;
                $patientprofile->pp_address = $request->pp_address;
                $patientprofile->pp_email = $request->pp_email;
		$patientprofile->save();

		$casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
		$casecare->patientprofile1_id = $patientprofile->id;
		$casecare->cc_patientid = trim($request->pp_patientid);
		$casecare->cc_contactor = $request->cc_contactor;
                $casecare->cc_contactor = $request->cc_contactor;
                $casecare->cc_contactor_tel = $request->cc_contactor_tel;
                $casecare->cc_language = $request->cc_language;
                $casecare->cc_mdate = $request->cc_mdate;
                $casecare->cc_mdatem = $request->cc_mdatem;
                $casecare->cc_type = $request->cc_type;
                $casecare->cc_ibw = $request->cc_ibw;
                $casecare->cc_bmi = $request->cc_bmi;
                $casecare->cc_waist = $request->cc_waist;
                $casecare->cc_butt = $request->cc_butt;
		if ($request->cc_status)
		{
			$casecare->cc_status = ($request->cc_status_c1 ? "1" : "0").($request->cc_status_c2 ? "1" : "0").($request->cc_status_c3 ? "1" : "0").($request->cc_status_c4 ? "1" : "0").($request->cc_status_c5 ? "1" : "0");
		} else {
	                $casecare->cc_status = "";
        	        $casecare->cc_status_other = "";
		}
                $casecare->cc_drink = $request->cc_drink;
                $casecare->cc_wine = $request->cc_wine;
                $casecare->cc_wineq = $request->cc_wineq;
                $casecare->cc_smoke = (($request->cc_smoke == 1 && $request->cc_smoke_time > 0) ? $request->cc_smoke_time : $request->cc_smoke);
                $casecare->cc_mh = $request->cc_mh;
                $casecare->cc_fh = $request->cc_fh;
                $casecare->cc_fh_desc = $request->cc_fh_desc;
                $casecare->cc_drug_allergy = $request->cc_drug_allergy;
                $casecare->cc_drug_allergy_name = $request->cc_drug_allergy_name;
                $casecare->cc_activity = $request->cc_activity;
                $casecare->cc_medicaretype = $request->cc_medicaretype;
                $casecare->cc_jobtime = $request->cc_jobtime;
                $casecare->cc_current_use = ($request->cc_current_use0 ? "1" : "0").($request->cc_current_use1 ? "1" : "0").($request->cc_current_use2 ? "1" : "0").($request->cc_current_use3 ? "1" : "0").($request->cc_current_use4 ? "1" : "0").($request->cc_current_use5 ? "1" : "0");
                $casecare->cc_starty = $request->cc_starty;
                $casecare->cc_startm = $request->cc_startm;
		$casecare->cc_hinder = ($request->cc_hinder0 ? "1":"0").($request->cc_hinder1 ? "1" : "0").($request->cc_hinder2 ? "1" : "0").($request->cc_hinder3 ? "1" : "0").($request->cc_hinder4 ? "1" : "0").($request->cc_hinder5 ? "1" : "0").($request->cc_hinder6 ? "1" : "0").($request->cc_hinder7 ? "1" : "0").($request->cc_hinder8 ? "1" : "0").($request->cc_hinder9 ? "1" : "0");
                $casecare->cc_hinder_desc = $request->cc_hinder_desc;
                $casecare->cc_act_time = $request->cc_act_time;
                $casecare->cc_act_kind = $request->cc_act_kind;
                $casecare->cc_edu = $request->cc_edu;
                $casecare->cc_careself = $request->cc_careself;
                $casecare->cc_careself_name = $request->cc_careself_name;
                $casecare->cc_careman = $request->cc_careman;
                $casecare->cc_careman_tel = $request->cc_careman_tel;
		if ($request->cc_usebsm)
		{
			$casecare->cc_usebsm = $request->cc_usebsm_name;
                }
		$casecare->cc_usebsm_frq = $request->cc_usebsm_frq;
		if ($request->cc_usebsm_frq) { // by month
			$casecare->cc_usebsm_unit = $request->cc_usebsm_frq_month;
		} else { // by week
			$casecare->cc_usebsm_unit = $request->cc_usebsm_frq_week;
		}
                $casecare->cc_g6pd = $request->cc_g6pd;
                $casecare->cc_deathdate = $request->cc_deathdate;
                $casecare->cc_deathdatem = $request->cc_deathdatem;
                $casecare->cc_smartphone = $request->cc_smartphone;
                $casecare->cc_wifi3g = $request->cc_wifi3g;
                $casecare->cc_smartphone_family = $request->cc_smartphone_family;
                $casecare->cc_familyupload = $request->cc_familyupload;
                $casecare->cc_uploadtodm = $request->cc_uploadtodm;
                $casecare->cc_appexp = $request->cc_appexp;
                $casecare->cc_lastexam = $request->cc_lastexam;
		$casecare->save();

                // bsm 血糖仪新增
                if ($request->cc_usebsm && $request->cc_usebsm_name==0 && $request->cc_otherbsm)
                {
                        $bsm = new BSM();
                        $bsm->bm_name = $request->cc_otherbsm;
                        $bsm->bm_model = $request->cc_otherbsm;
                        $bsm->save();

                        $casecare = CaseCare::where('patientprofile1_id', '=', $patientprofile->id)->firstOrFail();
                        $casecare->cc_usebsm = $bsm->id;
                        $casecare->save();
                }

		EventController::SaveEvent('patientprofile', 'update(更新)');
		return redirect()->route('patient.index')->with('message', '项目成功更新。');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$patientprofile = Patientprofile::findOrFail($id);
		$patientprofile->delete();

		$casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
		$casecare->delete();

		$user = User::findOrFail($casecare->cc_patientid);
		$user->delete();

		EventController::SaveEvent('patientprofile', 'destroy(删除)');
		return redirect()->route('patient.index')->with('message', '项目成功删除。');
	}

}
