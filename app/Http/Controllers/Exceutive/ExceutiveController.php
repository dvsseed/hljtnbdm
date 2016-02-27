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

    private $title = array(
        "day" => array("exec" => "三高績效統計日報表", "soap" => "SOAP績效統計日報表"),
        "week" => array("exec" => "三高績效統計周報表", "soap" => "SOAP績效統計周報表"),
        "month" => array("exec" => "三高績效統計月報表", "soap" => "SOAP績效統計月報表"),
        "season" => array("exec" => "三高績效統計季報表", "soap" => "SOAP績效統計季報表表"),
        "year" => array("exec" => "三高績效統計年報表", "soap" => "SOAP績效統計年報表")
    );
    private $types = array('a1c','ldl','bp');
    private $levels = array('mid','low','high');
    private $bounds = array(
        'a1c' => array('high' => 9, 'low' => 7),
        'ldl' => array('high' => 3.37, 'low' => 2.59),
        'bp' => array(
            's' => array('high' => 150, 'low' => 130),
            'e' => array('high' => 90, 'low' => 80)
            )
        );

    private $tags = array(
        'a1c' => array('high' => '>9', 'low' => '<7', 'mid' => ''),
        'ldl' => array('high' => '≥3.37', 'low' => '<2.59', 'mid' => ''),
        'bp' => array('high' => '>150/90', 'low' => '<130/80', 'mid' => '')
    );

    private $tags_title = array(
        'a1c' => 'A1C',
        'ldl' => 'LDL',
        'bp' => '血壓'
    );

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lists()
    {
        $titles = $this -> title;
        return view('executive.report', compact('titles'));
    }

    public function exec_stat( $type="soap", $range = "day" , $user_id = null)
    {
        $records = $this->exec_data($type, $range,$user_id);
        $chart_title = $this->title[$range][$type];
        $longest = $this -> get_longest($records);
        $base = "/executive/$type/$range";
        $name = $records[0]['data']['name'];
        if($user_id != null){
            $personal = true;
            $url = "$base/$user_id/$name$chart_title.xls";
        }else{
            $url = "$base/$name$chart_title.xls";
        }
        return view('executive.exec', compact('records', 'type', 'chart_title', 'url', 'longest', 'personal', 'base'));
    }

    private function exec_data($type = null, $range = "day", $user_id= null){
        $today = date('Y-m-d');
        $records = array();
        if($range == "day"){
            $start = date('Y-m-d', strtotime("-1 day", strtotime($today)));
            if($type == 'soap'){
                $record['data'] = $this->get_soap_stat($start, $today, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $today, $user_id);
            }
            $record['title'] = $start;
            array_push($records,$record);
        }else if($range == "week"){
            $start = date('Y-m-d', strtotime("-1 week", strtotime($today)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $today, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $today, $user_id);
            }
            $record['title'] = $start.'~'.$today;
            array_push($records,$record);
        }else if($range == "month"){
            $end = date('Y-m-d',mktime(0, 0, 0, date("m")  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-1 month", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end, $user_id);
            }
            $record['title'] = date('Y-m',strtotime($start));
            array_push($records,$record);
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end, $user_id);
            }
            $record['title'] = date('Y-m',strtotime($start));
            array_push($records,$record);
        }
        else if($range == "season"){
            $m = date("m");
            $end = date('Y-m-d',mktime(0, 0, 0, $m - ($m-1)%2  , 1, date("Y")));
            $start = date('Y-m-d', strtotime("-3 month", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end, $user_id);
            }
            $record['title'] = date('Y-m',strtotime($start)).'~'.date('Y-m',strtotime($end));
            array_push($records,$record);
            $start = date('Y-m-d', strtotime("-1 year", strtotime($start)));
            $end = date('Y-m-d',  strtotime("-1 year", strtotime($end)));
            if($type == 'soap') {
                $record['data'] = $this->get_soap_stat($start, $end, $user_id);
            }else if($type == "exec"){
                $record['data'] = $this->get_case_stat($start, $end, $user_id);
            }
            $record['title'] = date('Y-m',strtotime($start)).'~'.date('Y-m',strtotime($end));
            array_push($records,$record);
        }
        else if($range == "year"){
            $end = $today;
            for($year = date("Y");$year >= 2015; $year--){
                $start = date('Y-m-d',mktime(0, 0, 0, 1 , 1, $year));
                if($type == 'soap') {
                    $record['data'] = $this->get_soap_stat($start, $end, $user_id);
                }else if($type == "exec"){
                    $record['data'] = $this->get_case_stat($start, $end, $user_id);
                }
                $record['title'] = date('Y',strtotime($start));
                array_push($records,$record);
                $end = $start;
            }
        }

        return $records;
    }

    public function export_excel_person($type = "soap", $range = "day", $user_id, $content){
        return $this->export($type, $range, $content, $user_id);
    }

    public function export_excel($type = "soap", $range = "day", $content){
        return $this->export($type, $range, $content);
    }

    private function export($type = null, $range = "day", $content, $user_id = null){
        return Excel::create($content, function($excel) use($type, $range, $user_id) {
            $excel->sheet('New sheet', function($sheet) use($type, $range, $user_id) {
                $records = $this->exec_data($type, $range, $user_id);
                $chart_title = $this->title[$range][$type];
                $longest = $this -> get_longest($records);
                $base = "/executive/$type/$range";
                if($user_id != null){
                    $personal = true;
                    $url = "$base/$user_id/$chart_title.xls";
                }else{
                    $personal = false;
                    $url = "$base/$chart_title.xls";
                }
                $sheet->loadView('executive.soaphtml') -> with('records', $records) -> with('type', $type)
                    -> with('chart_title', $chart_title) -> with('url', $url) -> with('longest', $longest) -> with('xls','true') -> with('personal', $personal) -> with('base', $base);
            });
        })->export('xls');
    }

    private function get_longest($records){
        $longest = -1;

        foreach($records as $key => $record){
            if(count($record["data"]) > $longest){
                $longest = count($record["data"]);
            }
        }
        //exclude "count", "name"
        return $longest -2;
    }

    private function get_soap_stat($start, $end, $user_id =null){
        $query = UserSoapHistory::select(DB::raw('count(*) as count, users.name as nurse, user_soap_history.user_id as pk')) -> where('user_soap_history.health_date', '>=', $start) -> where('user_soap_history.health_date', '<', $end) -> where('user_soap_history.is_visible', '=', 1) -> leftJoin('users', 'user_soap_history.user_id', '=', 'users.id');
        $data = array();
        if($user_id != null){
            $records = $query -> where('user_soap_history.user_id', '=', $user_id) -> first();
            $total_count = UserSoapHistory::select(DB::raw('count(*) as total')) -> where('user_soap_history.health_date', '>=', $start) -> where('user_soap_history.health_date', '<', $end) -> where('user_soap_history.is_visible', '=', 1) -> first();

            if($total_count['total'] > 0){
                array_push($data, array('nurse' => $records['nurse'], 'count' => $records['count'], 'total' => $total_count['total']));
            }
            $data['count'] = $total_count['total'];
            $data['name'] = $records['nurse'];
        }else{
            $records =  $query-> groupBy('user_soap_history.user_id') -> get();

            $counter = 0;
            for($i = 0; $i < count($records); $i++){
                $count = $records[$i]['count'];
                $data[$i] = array('nurse' => $records[$i]['nurse'], 'count' => $count, 'nurse_detail' => $records[$i]['pk']);
                $counter += $count;
            }
            $data['count'] = $counter;
            $data['name'] = '全院';
        }

        return $data;
    }

    private function get_case_stat($start, $end, $user_id = null){
        $query = Caselist::select(DB::raw('users.name as name, cl_blood_hba1c as a1c, cl_ldl as ldl, cl_base_sbp, cl_base_ebp, cl_case_date, caselist.cl_doctor as doc')) -> where('cl_case_date', '>=', $start) -> where('cl_case_date', '<', $end) -> leftJoin('users', 'caselist.cl_doctor', '=', 'users.id');
        if($user_id != null){
            $query = $query -> where('caselist.cl_doctor', '=', $user_id);
        }
        $records =  $query-> orderBy('users.id') -> get();

        $data = array();
        $counter = 0;
        $doc_pk_mapping= array();

        foreach($records as $record){

            //a1c
            $level = 'mid';
            $type = 'a1c';
            if($record[$type] < $this->bounds[$type]['low']){
                $level = 'low';
            }else if($record['cl_blood_hba1c'] > $this->bounds[$type]['high']){
                $level = 'high';
            }
            if(isset($data[$type][$level][$record['doc']])){
                $data[$type][$level][$record['doc']] ++;
            }else{
                $data[$type][$level][$record['doc']] = 1;
            }

            //ldl
            $level = 'mid';
            $type = 'ldl';
            if($record[$type] < $this->bounds[$type]['low']){
                $level = 'low';
            }else if($record['cl_blood_hba1c'] > $this->bounds[$type]['high']){
                $level = 'high';
            }
            if(isset($data[$type][$level][$record['doc']])){
                $data[$type][$level][$record['doc']] ++;
            }else{
                $data[$type][$level][$record['doc']] = 1;
            }

            //bp
            $level = 'mid';
            $type = 'bp';
            if($record['cl_base_sbp'] < $this->bounds['bp']['s']['low'] && $record['cl_base_ebp'] < $this->bounds['bp']['e']['low']){
                $level = 'low';
            }else if($record['cl_base_sbp'] < $this->bounds['bp']['s']['high'] && $record['cl_base_ebp'] < $this->bounds['bp']['e']['high']){
                $level = 'high';
            }
            if(isset($data[$type][$level][$record['doc']])){
                $data[$type][$level][$record['doc']] ++;
            }else{
                $data[$type][$level][$record['doc']] = 1;
            }

            $doc_pk_mapping[$record['doc']] = $record['name'];
            $counter++;
        }
        //sort

        foreach($this -> types as $type){
            foreach($this -> levels as $level){
                if(isset($data[$type][$level])){
                    $doc_array = $data[$type][$level];
                    arsort($doc_array);
                    $data[$type][$level] = $doc_array;
                }
            }
        }

        //get total count for person
        if($user_id != null){
            $count = Caselist::select(DB::raw('count(*) as count')) -> where('cl_case_date', '>=', $start) -> where('cl_case_date', '<', $end) -> first();
            $total_count = $count['count'];

        }else{
            //just for initial
            $total_count = null;
        }

        //transform to output
        $export_data = array();
        foreach($this -> types as $type) {
            $one_data = array($this->tags_title[$type], '', '', '');
            array_push($export_data,$one_data);

            if($user_id == null){
                $sum_count = 0;
                foreach ($this->levels as $level) {
                    if(isset($data[$type][$level])) {
                        $sum_count += array_sum($data[$type][$level]);
                    }
                }
                $one_data = array('總筆數', $sum_count, '', '百分比');
                array_push($export_data,$one_data);
            }else{
                $sum_count = $total_count;
            }

            foreach ($this->levels as $level) {

                if(isset($data[$type][$level])){
                    reset($data[$type][$level]);
                    $first_key = key($data[$type][$level]);

                    foreach($data[$type][$level] as $doc => $count){
                        if($doc === $first_key){
                            $one_data = array($this->tags[$type][$level], $doc_pk_mapping[$doc], $count, $count.'/'.$sum_count);
                        }else{
                            $one_data = array("", $doc_pk_mapping[$doc], $count, $count.'/'.$sum_count);
                        }
                        $one_data["doctor_detail"] = $doc;
                        array_push($export_data,$one_data);
                    }
                }
            }
        }
        $export_data['count'] = $total_count;
        $export_data['name'] = "全院";
        if($user_id != null){
            $export_data['name'] = $doc_pk_mapping[$user_id];
        }
        return $export_data;
    }
}