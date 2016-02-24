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
use Excel;

class ExceutiveController extends Controller{

    private $alc_high = 9, $alc_low = 7, $ldl_high = 3.37, $ldl_low = 2.59, $sbp_high = 150, $sbp_low = 130, $ebp_high = 90, $ebp_low = 80;

    private $title = array(
        "day" => array("exec" => "日報表::三高績效統計表", "soap" => "日報表::SOAP績效統計表"),
        "week" => array("exec" => "周報表::三高績效統計表", "soap" => "周報表::SOAP績效統計表"),
        "month" => array("exec" => "月報表::三高績效統計表", "soap" => "月報表::SOAP績效統計表"),
        "season" => array("exec" => "季報表::三高績效統計表", "soap" => "季報表::SOAP績效統計表"),
        "year" => array("exec" => "年報表::三高績效統計表", "soap" => "年報表::SOAP績效統計表")
    );

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exec_stat( $type = null, $range = "day")
    {
        $records = $this->exec_data($type, $range);
        $chart_title = $this->title[$range][$type];
        $url = "/executive/$type/$range/$chart_title.xls";
        return view('executive.exec', compact('records', 'type', 'chart_title', 'url'));
    }

    private function exec_data($type = null, $range = "day"){
        $today = date('Y-m-d');
        $records = array();
        if($range == "day"){
            $start = date('Y-m-d', strtotime("-1 day", strtotime($today)));
            if($type == 'soap'){
                $record['data'] = $this->get_soap_stat($start, $today);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $today);
            }
            $record['title'] = $start;
            array_push($records,$record);
        }else if($range == "week"){
            $start = date('Y-m-d', strtotime("-1 week", strtotime($today)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $today);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $today);
            }
            $record['title'] = $start.'~'.$today;
            array_push($records,$record);
        }else if($range == "month"){
            $end = date('Y-m-d',mktime(0, 0, 0, date("m")  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-1 month", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end);
            }
            $record['title'] = date('Y-m',strtotime($start));
            array_push($records,$record);
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end);
            }
            $record['title'] = date('Y-m',strtotime($start));
            array_push($records,$record);
        }
        else if($range == "season"){
            $m = date("m");
            $end = date('Y-m-d',mktime(0, 0, 0, $m - ($m-1)%2  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-3 month", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end);
            }
            $record['title'] = date('Y-m',strtotime($start)).'~'.date('Y-m',strtotime($end));
            array_push($records,$record);
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end);
            }
            $record['title'] = date('Y-m',strtotime($start)).'~'.date('Y-m',strtotime($end));
            array_push($records,$record);
        }
        else if($range == "year"){
            $end = $today;
            for($year = date("Y");$year >= 2015; $year--){
                $start = date('Y-m-d',mktime(0, 0, 0, 1 , 1, $year));
                if($type == 'soap') {
                    $record['data'] = $this->get_soap_stat($start, $end);
                }else if($type == "exec"){
                    $record['data'] = $this->get_case_stat($start, $end);
                }
                $record['title'] = date('Y',strtotime($start));
                array_push($records,$record);
                $end = $start;
            }
        }

        return $records;
    }

    public function export_excel($type = null, $range = "day"){
        Excel::create($this->title[$range][$type], function($excel) use($type, $range) {
            $excel->sheet('New sheet', function($sheet) use($type, $range) {
                $records = $this->exec_data($type, $range);
                $chart_title = $this->title[$range][$type];
                $url = "/executive/$type/$range/$chart_title.xls";
                $sheet->loadView('executive.exec') -> with('records', $records) -> with('type', $type)
                    -> with('chart_title', $chart_title) -> with('url', $url);
            });
        })->export('xlsx');
    }

    private function get_soap_stat($start, $end){
        $records = UserSoapHistory::select(DB::raw('count(*) as count, users.name as nurse')) -> where('user_soap_history.health_date', '>=', $start) -> where('user_soap_history.health_date', '<', $end) -> where('user_soap_history.is_visible', '=', 1) -> leftJoin('user_soap', 'user_soap_history.user_soap_pk', '=', 'user_soap.user_soap_pk') -> leftJoin('hospital_no', 'user_soap.hospital_no_uuid', '=', 'hospital_no.hospital_no_uuid') -> leftJoin('users', 'hospital_no.nurse_user_id', '=', 'users.id') ->groupBy('hospital_no.nurse_user_id') -> get();

        $data = array();
        $counter = 0;
        foreach($records as $record){
            $count = $record['count'];
            $data["nurse"][$record['nurse']] = $count;
            $counter += $count;
        }
        $data['count'] = $counter;
        return $data;
    }

    private function get_case_stat($start, $end){
        $records = Caselist::select(DB::raw('users.name as doc, cl_blood_hba1c, cl_ldl, cl_base_sbp, cl_base_ebp, cl_case_date')) -> where('cl_case_date', '>=', $start) -> where('cl_case_date', '<', $end) -> leftJoin('users', 'caselist.cl_doctor', '=', 'users.id') -> orderBy('users.id') -> get();

        $data = array();
        $counter = 0;
        foreach($records as $record){
            if($record['cl_blood_hba1c'] < $this->alc_low){
                if(isset($data['a1c']['low'][$record['doc']])){
                    $data['a1c']['low'][$record['doc']] ++;
                }else{
                    $data['a1c']['low'][$record['doc']] = 1;
                }
            }else if($record['cl_blood_hba1c'] > $this->alc_high){
                if(isset($data['a1c']['high'][$record['doc']])){
                    $data['a1c']['high'][$record['doc']] ++;
                }else{
                    $data['a1c']['high'][$record['doc']] = 1;
                }
            }else{
                if(isset($data['a1c']['mid'][$record['doc']])){
                    $data['a1c']['mid'][$record['doc']] ++;
                }else{
                    $data['a1c']['mid'][$record['doc']] = 1;
                }
            }

            if($record['cl_ldl'] < $this->ldl_low){
                if(isset($data['ldl']['low'][$record['doc']])){
                    $data['ldl']['low'][$record['doc']] ++;
                }else{
                    $data['ldl']['low'][$record['doc']] = 1;
                }
            }else if($record['cl_ldl'] >= $this->ldl_high){
                if(isset($data['ldl']['high'][$record['doc']])){
                    $data['ldl']['high'][$record['doc']] ++;
                }else{
                    $data['ldl']['high'][$record['doc']] = 1;
                }
            }else{
                if(isset($data['ldl']['mid'][$record['doc']])){
                    $data['ldl']['mid'][$record['doc']] ++;
                }else{
                    $data['ldl']['mid'][$record['doc']] = 1;
                }
            }

            if($record['cl_base_sbp'] < $this->sbp_low && $record['cl_base_ebp'] < $this->ebp_low){
                if(isset($data['bp']['low'][$record['doc']])){
                    $data['bp']['low'][$record['doc']] ++;
                }else{
                    $data['bp']['low'][$record['doc']] = 1;
                }
            }else if($record['cl_base_sbp'] > $this->sbp_high && $record['cl_base_ebp'] > $this->ebp_high){
                if(isset($data['bp']['high'][$record['doc']])){
                    $data['bp']['high'][$record['doc']] ++;
                }else{
                    $data['bp']['high'][$record['doc']] = 1;
                }
            }else{
                if(isset($data['bp']['mid'][$record['doc']])){
                    $data['bp']['mid'][$record['doc']] ++;
                }else{
                    $data['bp']['mid'][$record['doc']] = 1;
                }
            }
            $counter++;
        }
        $data['count'] = $counter;
        return $data;
    }
}