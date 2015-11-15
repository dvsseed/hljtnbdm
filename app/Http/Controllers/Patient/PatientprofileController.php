<?php namespace App\Http\Controllers\Patient;

use App\Feature;
use App\Hasfeature;
use Carbon\Carbon;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Hash;
//use Session;
use App\Patientprofile;
use App\BSM;
use App\CaseCare;
use App\User;
use App\Http\Controllers\Event\EventController;
use Illuminate\Http\Request;

use App\Model\Pdata\HospitalNo;

class PatientprofileController extends Controller
{

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
        // $user = Auth::user();
        $search = $request->search;
        $category = $request->category;
//        if (Session::has('pasearch')) {
//            if ($search == null)
//                $search = Session::get('pasearch');
//            else
//                if ($search != Session::get('pasearch')) Session::put('pasearch', $search);
//        } else {
//            // $search = $request->search;
//            Session::put('pasearch', $search);
//        }
//        if (Session::has('pacategory')) {
//            if ($category == null)
//                $category = Session::get('pacategory');
//            else
//                if ($category != Session::get('pacategory')) Session::put('pacategory', $category);
//        } else {
//            // $category = $request->category;
//            Session::put('pacategory', $category);
//        }
        if ($search) {
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
        } else {
            $result = Patientprofile::orderBy('created_at', 'desc');
        }

        $count = $result->count();
        $patientprofiles = $result->paginate(10)->appends(['search' => $search, 'category' => $category]);
        //$hiss = DB::connection('oracle')->select('select * from pub_class_office'); // from HIS's db

        $current_user_id = Auth::user() -> id;
        // return view('patient.index', compact('patientprofiles', 'count', 'hiss'));
        return view('patient.index', compact('patientprofiles', 'count', 'hiss', 'search', 'category', 'current_user_id'));
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
        DB::beginTransaction();
        try {
            // validate
            $this->validate($request, [
                'account' => 'required|alpha_num|unique:users,account',
            ]);
            $this->validate($request, Patientprofile::rules());
            $this->validate($request, CaseCare::rules());

            // users
            $user = new User;
            $user->account = trim($request->account);
            $user->name = $request->pp_name;
            $user->password = Hash::make($user->account);
            $user->phone = $request->pp_mobile1;
            $user->email = $request->pp_email;
            $user->save();

            // patientprofile1
            $patientprofile = new Patientprofile();
            $patientprofile->user_id = $user->id;
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
            if ($request->cc_status) {
                $casecare->cc_status = ($request->cc_status_c1 ? "1" : "0") . ($request->cc_status_c2 ? "1" : "0") . ($request->cc_status_c3 ? "1" : "0") . ($request->cc_status_c4 ? "1" : "0") . ($request->cc_status_c5 ? "1" : "0");
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
            $casecare->cc_current_use = ($request->cc_current_use0 ? "1" : "0") . ($request->cc_current_use1 ? "1" : "0") . ($request->cc_current_use2 ? "1" : "0") . ($request->cc_current_use3 ? "1" : "0") . ($request->cc_current_use4 ? "1" : "0") . ($request->cc_current_use5 ? "1" : "0");
            $casecare->cc_starty = $request->cc_starty;
            $casecare->cc_startm = $request->cc_startm;
            $casecare->cc_hinder = ($request->cc_hinder0 ? "1" : "0") . ($request->cc_hinder1 ? "1" : "0") . ($request->cc_hinder2 ? "1" : "0") . ($request->cc_hinder3 ? "1" : "0") . ($request->cc_hinder4 ? "1" : "0") . ($request->cc_hinder5 ? "1" : "0") . ($request->cc_hinder6 ? "1" : "0") . ($request->cc_hinder7 ? "1" : "0") . ($request->cc_hinder8 ? "1" : "0") . ($request->cc_hinder9 ? "1" : "0");
            $casecare->cc_hinder_desc = $request->cc_hinder_desc;
            $casecare->cc_act_time = $request->cc_act_time;
            $casecare->cc_act_kind = $request->cc_act_kind;
            $casecare->cc_edu = $request->cc_edu;
            $casecare->cc_careself = $request->cc_careself;
            $casecare->cc_careself_name = $request->cc_careself_name;
            $casecare->cc_careman = $request->cc_careman;
            $casecare->cc_careman_tel = $request->cc_careman_tel;
            if ($request->cc_usebsm) {
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
            if ($request->cc_usebsm && $request->cc_usebsm_name == 0 && $request->cc_otherbsm) {
                $bsm = new BSM();
                $bsm->bm_name = $request->cc_otherbsm;
                $bsm->bm_model = $request->cc_otherbsm;
                $bsm->save();

                $casecare = CaseCare::where('patientprofile1_id', '=', $patientprofile->id)->firstOrFail();
                $casecare->cc_usebsm = $bsm->id;
                $casecare->save();
            }

            //create the hospital_no
            while(1){
                $uuid = uniqid('cn_');
                if(HospitalNo::find($uuid) == null){
                    break;
                }
            }
            $hospital_no = new HospitalNo();
            $hospital_no -> hospital_no_uuid = $uuid;
            $hospital_no -> patient_profile_id = $patientprofile -> id;
            $hospital_no -> patient_user_id = $patientprofile -> user_id;
            $hospital_no -> nurse_user_id = Auth::user() -> id;
            $hospital_no -> hospital_no_displayname = substr($request->input("pp_patientid"),0,-6).'xxxxxx';
            $hospital_no -> save();

            //enable feature
            $featurs_id = Feature::where('href', '=', '/bdata') -> first() -> id;
            $hasfeatures = new Hasfeature();
            $hasfeatures -> user_id =  $patientprofile -> user_id;
            $hasfeatures -> feature_id =  $featurs_id;
            $hasfeatures -> save();

            $msg = '项目成功创建。';
            DB::commit();
            EventController::SaveEvent('patientprofile', 'store(保存)');
        } catch (\Exception $e) {
            $msg = '项目创建失败。';
            DB::rollback();
        }

        return redirect()->route('patient.index')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $patientprofile = Patientprofile::findOrFail($id);
        $casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
        $carbon = Carbon::today();
        $year = $carbon->year;
        $bsms = BSM::orderBy('bm_order')->get();
        $account = User::findOrFail($patientprofile->user_id)->account;

        EventController::SaveEvent('patientprofile', 'show(显示)');
        return view('patient.show', compact('patientprofile', 'casecare', 'year', 'bsms', 'account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $patientprofile = Patientprofile::findOrFail($id);
        $casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
        $carbon = Carbon::today();
        $year = $carbon->year;
        $bsms = BSM::orderBy('bm_order')->get();
        $account = User::findOrFail($patientprofile->user_id)->account;

        EventController::SaveEvent('patientprofile', 'edit(编辑)');
        return view('patient.edit', compact('patientprofile', 'casecare', 'year', 'bsms', 'account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // validate
            $this->validate($request, Patientprofile::updaterules());

            // patientprofile1
            $patientprofile = Patientprofile::findOrFail($id);
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

            // casecare
            $casecare = CaseCare::where('patientprofile1_id', '=', $id)->firstOrFail();
            // $casecare->patientprofile1_id = $patientprofile->id;
            // $casecare->cc_patientid = trim($request->pp_patientid);
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
            if ($request->cc_status) {
                $casecare->cc_status = ($request->cc_status_c1 ? "1" : "0") . ($request->cc_status_c2 ? "1" : "0") . ($request->cc_status_c3 ? "1" : "0") . ($request->cc_status_c4 ? "1" : "0") . ($request->cc_status_c5 ? "1" : "0");
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
            $casecare->cc_current_use = ($request->cc_current_use0 ? "1" : "0") . ($request->cc_current_use1 ? "1" : "0") . ($request->cc_current_use2 ? "1" : "0") . ($request->cc_current_use3 ? "1" : "0") . ($request->cc_current_use4 ? "1" : "0") . ($request->cc_current_use5 ? "1" : "0");
            $casecare->cc_starty = $request->cc_starty;
            $casecare->cc_startm = $request->cc_startm;
            $casecare->cc_hinder = ($request->cc_hinder0 ? "1" : "0") . ($request->cc_hinder1 ? "1" : "0") . ($request->cc_hinder2 ? "1" : "0") . ($request->cc_hinder3 ? "1" : "0") . ($request->cc_hinder4 ? "1" : "0") . ($request->cc_hinder5 ? "1" : "0") . ($request->cc_hinder6 ? "1" : "0") . ($request->cc_hinder7 ? "1" : "0") . ($request->cc_hinder8 ? "1" : "0") . ($request->cc_hinder9 ? "1" : "0");
            $casecare->cc_hinder_desc = $request->cc_hinder_desc;
            $casecare->cc_act_time = $request->cc_act_time;
            $casecare->cc_act_kind = $request->cc_act_kind;
            $casecare->cc_edu = $request->cc_edu;
            $casecare->cc_careself = $request->cc_careself;
            $casecare->cc_careself_name = $request->cc_careself_name;
            $casecare->cc_careman = $request->cc_careman;
            $casecare->cc_careman_tel = $request->cc_careman_tel;
            if ($request->cc_usebsm) {
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

            // bsm
            if ($request->cc_usebsm && $request->cc_usebsm_name == 0 && $request->cc_otherbsm) {
                $bsm = new BSM();
                $bsm->bm_name = $request->cc_otherbsm;
                $bsm->bm_model = $request->cc_otherbsm;
                $bsm->save();

                $casecare = CaseCare::where('patientprofile1_id', '=', $patientprofile->id)->firstOrFail();
                $casecare->cc_usebsm = $bsm->id;
                $casecare->save();
            }

            $msg = '项目成功更新。';
            DB::commit();
            EventController::SaveEvent('patientprofile', 'update(更新)');
        } catch (\Exception $e) {
            $msg = '项目更新失败。';
            DB::rollback();
        }

        return redirect()->route('patient.index')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $casecare = CaseCare::where('patientprofile1_id', '=', $id)->first();
            if ($casecare) {
                $casecare->delete();
                $patientprofile = Patientprofile::find($id);
                if ($patientprofile) {
                    $this->cleanUpHospital($patientprofile -> hospital_no);
                    $hasfeature = Hasfeature::where('user_id', '=', $patientprofile->user_id) -> first();
                    if($hasfeature != null){
                        $hasfeature -> delete();
                    }
                    $patientprofile->delete();
                    $user = User::find($patientprofile->user_id);
                    if ($user) {
                        $user->delete();
                        $msg = '患者资料成功删除。';
                    } else {
                        $msg = '使用者删除失败。';
                    }
                } else {
                    $msg = '患者资料删除失败。';
                }
            } else {
                $msg = '患者细项资料删除失败。';
            }

            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
            EventController::SaveEvent('patientprofile', 'destroy(删除)');
        } catch (\Exception $e) {
            $msg = '资料删除失败。';
            DB::rollback();
        }

        return redirect()->back()->with('message', $msg);
    }

    private function cleanUpHospital($hospital){

        if($hospital != null){
            $blood_sugars = $hospital -> blood_sugar;
            foreach( $blood_sugars as $blood_sugar){
                $details = $blood_sugar -> blood_sugar_detail;
                foreach( $details as $detail){
                    $detail -> delete();
                }
                $blood_sugar -> delete();
            }

            $food_records = $hospital -> food_record;
            foreach( $food_records as $food_record){
                $details = $food_record -> food_detail;
                foreach( $details as $detail){
                    $detail -> delete();
                }
                $food_record -> delete();
            }

            $messages = $hospital -> messages;
            foreach( $messages as $message){
                $message -> delete();
            }
            $hospital -> delete();

            $user_soap = $hospital -> user_soap;
            $histories = $user_soap -> history;
            foreach( $histories as $history){
                $histories -> delete();
            }
            $user_soap -> delete();
        }
    }

    /**
     * Session forget.
     *
     * @param  int $key
     * @return Response
     */
//    public function forget($key)
//    {
//        if ($key) {
//            Session::forget('pasearch');
//            Session::forget('pacategory');
//        }
//        return redirect()->route('patient.index')->with('message', '搜寻文字已清除。');
//    }

    /**
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('patient.about');
    }

}
