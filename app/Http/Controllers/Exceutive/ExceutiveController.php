<?php namespace App\Http\Controllers\Exceutive;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2016/2/22
 * Time: 下午 08:35
 */

use App\Http\Controllers\Controller;
use App\Model\SOAP\UserSoapHistory;
use App\Caselist;
use DB;

class ExceutiveController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exec_stat( $type = null, $range = "day")
    {
        echo $type;
        $today = date('Y-m-d');
        $records = array();
        if($range == "day"){
            $start = date('Y-m-d', strtotime("-1 day", strtotime($today)));
            if($type == 'soap'){
                array_push($records,$this->get_soap_stat($start, $today));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $today));
            }

        }else if($range == "week"){
            $start = date('Y-m-d', strtotime("-1 week", strtotime($today)));
            if($type == 'soap') {
                array_push($records, $this->get_soap_stat($start, $today));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $today));
            }
        }else if($range == "month"){
            $end = date('Y-m-d',mktime(0, 0, 0, date("m")  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-1 month", strtotime($end)));
            if($type == 'soap') {
                array_push($records, $this->get_soap_stat($start, $end));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $end));
            }
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                array_push($records, $this->get_soap_stat($start, $end));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $end));
            }
        }
        else if($range == "season"){
            $m = date("m");
            $end = date('Y-m-d',mktime(0, 0, 0, $m - ($m-1)%2  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-3 month", strtotime($end)));
            if($type == 'soap') {
                array_push($records, $this->get_soap_stat($start, $end));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $end));
            }
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                array_push($records, $this->get_soap_stat($start, $end));
            }else if($type == "exec"){
                array_push($records,$this->get_case_stat($start, $end));
            }
        }
        else if($range == "year"){
            $end = $today;
            for($year = date("Y");$year >= 2015; $year--){
                $start = date('Y-m-d',mktime(0, 0, 0, 1 , 1, $year));
                if($type == 'soap') {
                    array_push($records, $this->get_soap_stat($start, $end));
                }else if($type == "exec"){
                    array_push($records,$this->get_case_stat($start, $end));
                }
                $end = $start;
            }
        }

        return $records;
    }

    private function get_soap_stat($start, $end){
        $records = UserSoapHistory::select(DB::raw('count(*) as count, users.name')) -> where('user_soap_history.health_date', '>=', $start) -> where('user_soap_history.health_date', '<', $end) -> where('user_soap_history.is_visible', '=', 1) -> leftJoin('user_soap', 'user_soap_history.user_soap_pk', '=', 'user_soap.user_soap_pk') -> leftJoin('hospital_no', 'user_soap.hospital_no_uuid', '=', 'hospital_no.hospital_no_uuid') -> leftJoin('users', 'hospital_no.nurse_user_id', '=', 'users.id') ->groupBy('hospital_no.nurse_user_id') -> get();

        return $records;
    }

    private function get_case_stat($start, $end){
        $records = Caselist::select(DB::raw('count(*) count, users.name')) -> where('cl_case_date', '>=', $start) -> where('cl_case_date', '<', $end) -> leftJoin('users', 'caselist.cl_doctor', '=', 'users.id') -> groupBy('cl_doctor') -> get();

        return $records;
    }
}