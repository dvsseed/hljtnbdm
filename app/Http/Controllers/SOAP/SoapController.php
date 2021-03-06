<?php namespace App\Http\Controllers\SOAP;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 10/31/2015
 * Time: 10:30 PM
 */

use App\Feature;
use App\Model\SOAP\SoaNurseClass;
use App\User;
use App\Buildcase;
use App\Http\Controllers\Controller;
use App\Model\Pdata\HospitalNo;
use App\Model\SOAP\SubClass;
use App\Model\SOAP\SoaClass;
use App\Model\SOAP\MainClass;
use App\Model\SOAP\UserCustomize;
use App\Model\SOAP\UserSoap;
use App\Model\SOAP\UserSoapHistory;
use App\Model\Pdata\BloodSugar;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use Redirect;

class SoapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page($uuid, Request $request){

        $main_classes = MainClass::all();
        $sub_classes = $this->get_sub_class($main_classes -> first() -> main_class_pk);
        $soa_classes = $this->get_soa_class($sub_classes -> first() -> sub_class_pk);
        $soa_nurse_classes[0] = SoaNurseClass::where('type','=',1)->orderBy('soa_nurse_class_pk')->get();
        $soa_nurse_classes[1] = SoaNurseClass::where('type','=',2)->orderBy('soa_nurse_class_pk')->get();

        $hospital_no = HospitalNo::find($uuid);
        $users = Auth::user();

        if( $hospital_no == null){
            $err_msg = "没有SOAP资料!";
        }else{
            if($hospital_no -> patient_user_id == $users -> id ){
                return Redirect::route('bdata');
            }
//            $user_feature = Feature::where('href', '=', '/patient') -> first() -> hasfeatures() -> where('user_id', '=', $users -> id)->first();
//            if($user_feature == null){
//                $hospital_no = null;
//                $err_msg = "您没有权限查看此资料";
//            }
            $psn = array("患者");
            if (in_array($users->position, $psn)) {
                $hospital_no = null;
                $err_msg = "您没有权限查看此资料";
            }
        }

        $history_pk = null;
        if($hospital_no == null){
            return view('soap.soap', compact('err_msg', 'history_pk'));
        }

        $user_soa_nurse_pks = [];
        $user_soap = null;

        $user_data = array();
        if(isset($request['history'])){
            $history = UserSoapHistory::find($request['history']);
            if($history != null){
                $user_soap = $history;
                $history_pk = $history -> user_soap_history_pk;
            }
        }

        if(isset($request['calendar_date'])){
            $blood_sugar = $hospital_no -> blood_sugar() -> where('calendar_date', '=', $request['calendar_date']) -> first();
            if($blood_sugar != null){
                $history = $blood_sugar -> history_soap;
                if($history!= null){
                    $user_soap = $history;
                    $history_pk = $history -> user_soap_history_pk;
                }
            }
            Session::put('calendar_date', $request['calendar_date']);
        }else{
            Session::forget('calendar_date');
        }

        $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->orderBy('build_at','desc')->first();
        $memo = "";
        $burl = "#";
        if($buildcase !== null){
            $memo = $buildcase -> memo;
            $burl = "/dm/eedit/".$buildcase->id;
        }

        if($user_soap == null || (isset($request['new']) && $request['new'] == true)){
            $user_data['S'] = "";
            $user_data['O'] = "";
            $user_data['A'] = "";
            $user_data['P'] = "";
            $user_data['E'] = "";
            $user_data['R'] = "";
            if($buildcase !== null && $buildcase -> soap_status == 0){
                $user_soa_nurse_pks = $buildcase-> soa_nurse_class_pks0.','.$buildcase-> soa_nurse_class_pks1;
                $user_soa_nurse_pks = $this->get_user_soa_array($user_soa_nurse_pks, false);
            }
        }else{
            $user_data['S'] = $user_soap -> s_text;
            $user_data['O'] = $user_soap -> o_text;
            $user_data['A'] = $user_soap -> a_text;
            $user_data['P'] = $user_soap -> p_text;
            $user_data['E'] = $user_soap -> e_text;
            $user_data['R'] = $user_soap -> r_text;
            $user_soa_nurse_pks = $this->get_user_soa_array($user_soap -> soa_nurse_class_pks, $user_soap -> is_finished);
        }

        Session::put('uuid', $uuid);

        return view('soap.soap', compact('main_classes', 'sub_classes', 'soa_classes', 'user_data', 'uuid', 'history_pk', 'soa_nurse_classes', 'user_soa_nurse_pks', 'memo', 'burl'));
    }

    private function get_user_soa_array($user_soa_nurse_pks, $finished){
        if($user_soa_nurse_pks != null && $finished != 1){
            $user_soa_nurse_pks = explode(",", $user_soa_nurse_pks);
        }else{
            $user_soa_nurse_pks = [];
        }
        return $user_soa_nurse_pks;
    }

    public function delete_history(Request $request){
        $user_soap_history = UserSoapHistory::find($request['history']);
        if($user_soap_history != null){
            DB::beginTransaction();
            try{
                $user_soap_history -> delete();
                DB::commit();
                return "success";
            }catch (\Exception $e){

                DB::rollback();
                return "fail";
            }
        }
    }

    public function get_history($uuid){

        $hospital_no = HospitalNo::find($uuid);
        $users = Auth::user();
        if( $hospital_no == null){
            $err_msg = "無效的病歷";
            if($hospital_no -> nurse_user_id != $users -> id){
                $hospital_no = null;
                $err_msg = "您没有权限查看此资料";
            }
        }

        if($hospital_no == null){
            return view('soap.soap', compact('err_msg'));
        }

        $hospital_no_displayname = $hospital_no -> patient -> pp_patientid;
        $user_soap = $hospital_no -> user_soap;
        $histories = array();
        if($user_soap != null){
            $histories = $user_soap -> history() -> where('is_visible', '=', '1') -> orderBy('updated_at', 'desc') -> get();
        }
        foreach($histories as $history){
            $user = User::find($history -> user_id);
            $history -> user_id = $user -> name;
            $history -> position = $user -> position;
        }
        return view('soap.history', compact('histories', 'hospital_no_displayname', 'uuid'));
    }

    public function get_sub_class($main_class_pk){
        $main_class = MainClass::find($main_class_pk);

        if($main_class != null){
            $sub_classes = $main_class -> sub_class;
            return $sub_classes;
        }

        return null;
    }

    public function get_soa_class($sub_class_pk){
        $sub_class = SubClass::find($sub_class_pk);

        $soa_data = array();
        $soa_data['S'] = array();
        $soa_data['O'] = array();
        $soa_data['A'] = array();
        $soa_data['P'] = array();
        $soa_data['E'] = array();
        if($sub_class != null){
            $soa_data['S'] = $sub_class -> soa_class() -> where('type', '=', 'S')->get();
            $soa_data['O'] = $sub_class -> soa_class() -> where('type', '=', 'O')->get();
            $soa_data['A'] = $sub_class -> soa_class() -> where('type', '=', 'A')->get();
            $soa_data['P'] = $sub_class -> soa_class() -> where('type', '=', 'P')->get();
            $soa_data['E'] = $sub_class -> soa_class() -> where('type', '=', 'E')->get();
        }
        return $soa_data;
    }

    public function get_soa_detail($soa_class_pk){
        $soa_class = SoaClass::find($soa_class_pk);

        if($soa_class != null){
            $soa_detail = $soa_class -> soa_detail;
            return $soa_detail;
        }
        return null;
    }

    public function get_customize($class,$type){
        $user_id = Auth::user() -> id;
        return UserCustomize::where('user_id', '=' , $user_id) -> where('main_class_pk', '=', $class) -> where('type', '=', $type) -> get();
    }

    public function post_customize(Request $request){
        $user_id = Auth::user() -> id;

        DB::beginTransaction();
        try{
            $userCustomize = new UserCustomize();
            $userCustomize -> main_class_pk = $request -> main_class;
            $userCustomize -> type = $request -> types;
            $userCustomize -> text = $request -> text;
            $userCustomize -> user_id = $user_id;
            $userCustomize -> save();
            DB::commit();
            return "success";
        }catch (\Exception $e){
            DB::rollback();
            return "fail";
        }
    }

    public function post_user_soap(Request $request){

        $uuid = Session::get('uuid');
        $uid = Auth::user()->id;
        $calendar_date = Session::get('calendar_date');
        $user_soap = UserSoap::where('hospital_no_uuid', '=', $uuid) -> first();
        $user_id = Auth::User() -> id;

        $bsugar = HospitalNo::find($uuid) -> blood_sugar() -> where('calendar_date', '=', $calendar_date) -> first();
        DB::beginTransaction();
        try{
            if($bsugar == null && $calendar_date != null){
                $bsugar = new BloodSugar();
                $bsugar->calendar_date = $calendar_date;
                $bsugar->early_morning = null;
                $bsugar->morning = null;
                $bsugar->breakfast_before = null;
                $bsugar->breakfast_after = null;
                $bsugar->lunch_before = null;
                $bsugar->lunch_after = null;
                $bsugar->dinner_before = null;
                $bsugar->dinner_after = null;
                $bsugar->sleep_before = null;
                $bsugar->note = null;
                $bsugar->hospital_no_uuid = $uuid;
                $bsugar->user_id = $user_id;
                $bsugar -> save();
            }else{
                if($user_soap == null){
                    $user_soap = new UserSoap();
                }
                $user_soap -> hospital_no_uuid = $uuid;
                $user_soap -> s_text = $request -> s_text;
                $user_soap -> o_text = $request -> o_text;
                $user_soap -> a_text = $request -> a_text;
                $user_soap -> p_text = $request -> p_text;
                $user_soap -> e_text = $request -> e_text;
                $user_soap -> r_text = $request -> r_text;
                $user_soap -> health_date = $request -> health_date;
                $user_soap -> soa_nurse_class_pks = $request -> soa_nurse_class_pks;

                if(isset($request["confirm"]) && $request -> confirm == "true"){
                    $user_soap -> is_finished = true;
                }else{
                    $user_soap -> is_finished = false;
                }
                $user_soap -> save();
            }

            $user_soap_history = new UserSoapHistory();
            $user_soap_history -> s_text = $request -> s_text;
            $user_soap_history -> o_text = $request -> o_text;
            $user_soap_history -> a_text = $request -> a_text;
            $user_soap_history -> p_text = $request -> p_text;
            $user_soap_history -> e_text = $request -> e_text;
            $user_soap_history -> r_text = $request -> r_text;
            $user_soap_history -> health_date = $request -> health_date;
            $user_soap_history -> user_id = Auth::user() -> id;
            $user_soap_history -> created_at = $user_soap -> created_at;
            $user_soap_history -> soa_nurse_class_pks = $request -> soa_nurse_class_pks;

            if(isset($request["confirm"]) && $request -> confirm == "true"){
                $user_soap_history -> is_finished = true;
            }else{
                $user_soap_history -> is_finished = false;
            }
            if($user_soap != null){
                $user_soap_history -> user_soap_pk = $user_soap -> user_soap_pk;
            }
            if($bsugar != null){
                $user_soap_history -> blood_sugar_pk = $bsugar -> blood_sugar_pk;
            }

            if(isset($request["history"])){
                $history = $user_soap -> history() -> find($request["history"]);

                if($history != null){
                    $user_soap_history -> old_pk = $history -> user_soap_history_pk;
                    $history -> is_visible = 0;

                    $history -> save();
                }
            }

            $user_soap_history -> save();

            if($user_soap->is_finished == true) { // 完成

                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid) -> orderBy('build_at', 'desc') -> first();
                if($buildcase) {
                    $buildcase -> soap_status = 1;
                    $buildcase -> save();
                }

                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('duty','=',$uid)->first();
                if($buildcase) {
                    $buildcase->duty_status = 2;
                    $buildcase->save();
                }
                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('nurse','=',$uid)->first();
                if($buildcase) {
                    $buildcase->nurse_status = 2;
                    $buildcase->save();
                }
                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('dietitian','=',$uid)->first();
                if($buildcase) {
                    $buildcase->dietitian_status = 2;
                    $buildcase->save();
                }
            } else { // 暫存

                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid) -> orderBy('build_at', 'desc') -> first();
                if($buildcase) {
                    $buildcase -> soap_status = 0;
                    $buildcase -> save();
                }

                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('duty','=',$uid)->first();
                if($buildcase) {
                    $buildcase->duty_status = 1;
                    $buildcase->save();
                }
                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('nurse','=',$uid)->first();
                if($buildcase) {
                    $buildcase->nurse_status = 1;
                    $buildcase->save();
                }
                $buildcase = Buildcase::where('hospital_no_uuid','=',$uuid)->where('dietitian','=',$uid)->first();
                if($buildcase) {
                    $buildcase->dietitian_status = 1;
                    $buildcase->save();
                }
            }

            DB::commit();
            return "success /bdata/$uuid";
        }catch (\Exception $e){
            DB::rollback();
	        return "$e";
        }
    }
}
