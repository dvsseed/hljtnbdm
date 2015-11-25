<?php namespace App\Http\Controllers\SOAP;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 10/31/2015
 * Time: 10:30 PM
 */

use App\Feature;
use App\User;
use App\Http\Controllers\Controller;
use App\Model\Pdata\HospitalNo;
use App\Model\SOAP\SubClass;
use App\Model\SOAP\SoaClass;
use App\Model\SOAP\MainClass;
use App\Model\SOAP\UserCustomize;
use App\Model\SOAP\UserSoap;
use App\Model\SOAP\UserSoapHistory;
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

        $hospital_no = HospitalNo::find($uuid);
        $users = Auth::user();

        if( $hospital_no == null){
            $err_msg = "无效的病历";
        }else{
            if($hospital_no -> patient_user_id == $users -> id ){
                return Redirect::route('bdata');
            }
            $user_feature = Feature::where('href', '=', '/patient') -> first() -> hasfeatures() -> where('user_id', '=', $users -> id)->first();

            if($user_feature == null){
                $hospital_no = null;
                $err_msg = "您没有权限查看此资料";
            }
        }

        if($hospital_no == null){
            return view('soap.soap', compact('err_msg'));
        }

        $user_soap = UserSoap::where('hospital_no_uuid', '=', $uuid)->first();

        $user_data = array();
        $history_pk = null;

        if($user_soap != null && isset($request['history'])){
            $history = $user_soap -> history() -> find($request['history']);
            if($history != null){
                $user_soap = $history;
                $history_pk = $history -> user_soap_history_pk;
            }
        }

        if($user_soap == null || (isset($request['new']) && $request['new'] == true)){
            $user_data['S'] = "";
            $user_data['O'] = "";
            $user_data['A'] = "";
            $user_data['P'] = "";
            $user_data['E'] = "";
            $user_data['R'] = "";
        }else{
            $user_data['S'] = $user_soap -> s_text;
            $user_data['O'] = $user_soap -> o_text;
            $user_data['A'] = $user_soap -> a_text;
            $user_data['P'] = $user_soap -> p_text;
            $user_data['E'] = $user_soap -> e_text;
            $user_data['R'] = $user_soap -> r_text;
        }
        Session::put('uuid', $uuid);

        return view('soap.soap', compact('main_classes', 'sub_classes', 'soa_classes', 'user_data', 'uuid', 'history_pk'));
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
            $history -> user_id = User::find($history -> user_id) -> name;
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
        $user_soap = UserSoap::where('hospital_no_uuid', '=', $uuid) -> first();

        if($user_soap == null){
            $user_soap = new UserSoap();
        }

        DB::beginTransaction();
        try{
            $user_soap -> hospital_no_uuid = $uuid;
            $user_soap -> s_text = $request -> s_text;
            $user_soap -> o_text = $request -> o_text;
            $user_soap -> a_text = $request -> a_text;
            $user_soap -> p_text = $request -> p_text;
            $user_soap -> e_text = $request -> e_text;
            $user_soap -> r_text = $request -> r_text;
            $user_soap -> save();

            $user_soap_history = new UserSoapHistory();
            $user_soap_history -> s_text = $request -> s_text;
            $user_soap_history -> o_text = $request -> o_text;
            $user_soap_history -> a_text = $request -> a_text;
            $user_soap_history -> p_text = $request -> p_text;
            $user_soap_history -> e_text = $request -> e_text;
            $user_soap_history -> r_text = $request -> r_text;
            $user_soap_history -> user_soap_pk = $user_soap -> user_soap_pk;
            $user_soap_history -> user_id = Auth::user() -> id;
            $user_soap_history -> created_at = $user_soap -> created_at;

            if(isset($request["history"])){
                $history = $user_soap -> history() -> find($request["history"]);

                if($history != null){
                    $user_soap_history -> old_pk = $history -> user_soap_history_pk;
                    $history -> is_visible = 0;

                    $history -> save();
                }
            }

            $user_soap_history -> save();

            DB::commit();
            return "success";
        }catch (\Exception $e){
            DB::rollback();
            return "fail";
        }
    }

   /*public function convert(){

        $mapping_str = "RP1	认识肾脏的基本结构及功能
RP2	介绍肾脏疾病常见症状及检查值
RP3	说明肾病日常生活保健及预防
RP4	介绍肾病的危险因子
RP5	介绍肾脏疾病分期及注意事项
RP6	说明肾功能无法适当发挥作用时，身体会发生的状况,建议与肾脏科讨论病情
RP7	教导高血压、高血脂、糖尿病与肾病的相关性
RP8	教导定期追踪的重要性
RP9	教导服用药物(包括中草药及健康食品)前，须先咨询医师意见
";

        $data = "糖尿病肾病变认知不足	RP1	RP2	RP3	RP4	RP5	RP6	RP7	RP8	RP9";

        $lines = explode( "\n" , $data );

        $mapping_lines = explode( "\n" , $mapping_str );
        $mapping_data = array();

        foreach($mapping_lines as $mapping_line){
            $column = explode("\t", $mapping_line);
            if(count($column) > 1){
                $mapping_data[$column[0]] = $column[1];
            }
        }

        foreach($lines as $line){
            $column = explode("\t", $line);
            if(count($column) > 1){
                $lead = $column[0];
                $soa_class = Soa_class::where('class_name','=', $lead) -> first() ;

                if($soa_class != null){
                    $soa_class_pk = $soa_class -> soa_class_pk;
                    for($i = 1; $i < count($column); $i++){
                        if($column[$i] != null){
                            echo "INSERT INTO  soa_detail  (`detail_name`,`soa_class_pk`) VALUES ('".$mapping_data[trim($column[$i])]."',".$soa_class_pk.");";
                            echo '<br/>';
                        }
                    }
                }else{
                    echo $lead.'<br/>';
                }
            }
        }

        return ;
    }*/
}