<?php namespace App\Http\Controllers\BData;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/21
 * Time: �U�� 09:36
 */

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pdata\BloodSugar;
use App\Model\Pdata\BloodSugarDetail;
use App\Model\Pdata\HospitalNo;
use App\User;
use Session;
use Auth;


    class BDataController extends Controller{

        public function __construct()
        {
            $this->middleware('auth');
        }

        public function page( $uuid, $end = null)
        {
            if($end == null)
                $end = date('Y-m-d');
            $start = date('Y-m-d', strtotime("-2 week", strtotime($end)));

            $users = Auth::user();

            $hospital_no = HospitalNo::find($uuid)->where('patient_user_id', '=', $users->id)->orWhere('nurse_user_id', '=', $users->id)->first();

            if($hospital_no->count() ==0 ) {
                $invalid = true;
                return view('bdata.bdata', compact('invalid'));
            }
            $hospital_no = $hospital_no->first();

            $displayname = $hospital_no->hospital_no_displayname;
            $patient_displayname = User::find($hospital_no->patient_user_id)->name;

            $blood_records = $hospital_no->blood_sugar()->where('calendar_date', '<=', $end)->where('calendar_date', '>=', $start)->orderBy('calendar_date', 'DESC')->get();
            $blood_records = $this->fillup($blood_records,$start,$end);

            Session::put('blood_records', $blood_records);
            Session::put('uuid', $uuid);

            return view('bdata.bdata', compact('blood_records', 'displayname', 'patient_displayname'));
        }

        public function get_detail( $calendar_date, $measure_type){
            $blood_records = Session::get('blood_records', function() {
                return null;
            });

            if($blood_records != null){
                foreach($blood_records as $blood_record){
                    if($blood_record->calendar_date == $calendar_date){
                        $detail = $blood_record->blood_sugar_detail()->where('measure_type' , "=", $measure_type)->first();
                        return $detail;
                    }
                }
            }
            return null;
        }

        private function fillup($data, $start, $end){
            $index = 0;
            $filled_date = array();
            $current = $end;

            for($current = $end; $current != $start; $current = date('Y-m-d', strtotime('-1 day', strtotime($current)))){
                if($index<count($data) && $data[$index]->calendar_date == $current){
                    array_push($filled_date,$data[$index]);
                    $index ++;
                }else{
                    $bsugar = new BloodSugar();
                    $bsugar->calendar_date = $current;
                    $bsugar->early_morning = null;
                    $bsugar->morning = null;
                    $bsugar->breakfast_before = null;
                    $bsugar->breakfast_after = null;
                    $bsugar->lunch_before = null;
                    $bsugar->lunch_after = null;
                    $bsugar->dinner_brfore = null;
                    $bsugar->dinner_after = null;
                    $bsugar->sleep_before = null;
                    $bsugar->note = null;
                    $bsugar->hostaple_no_pk = 'test12345';
                    array_push($filled_date,$bsugar);
                }
            }
            return $filled_date;
        }

        public function upsert(Request $request){
            if(!isset($request->blood_sugar) && $request->blood_sugar == null){
                return "fail";
            }
            $uuid = Session::get('uuid');
            $users = Auth::user();

            $blood_sugar = HospitalNo::find($uuid)->blood_sugar()->firstOrNew(array('calendar_date' => $request->calendar_date));
            $blood_sugar -> calendar_date = $request -> calendar_date;
            $blood_sugar[$request->measure_type] = $request -> blood_sugar;
            $blood_sugar -> user_id = $users->id;
            $blood_sugar -> save();

            $this->validate($request, BloodSugarDetail::rules());
            $blood_sugar_detail = new BloodSugarDetail();
            $blood_sugar_detail -> measure_time = date('Y-m-d H:i', strtotime($request -> measure_time)) ;
            $blood_sugar_detail -> measure_type = $request -> measure_type ;
            $blood_sugar_detail -> exercise_type = $request -> exercise_type ;
            $blood_sugar_detail -> exercise_duration = $request -> exercis_duration ;
            $blood_sugar_detail -> insulin_type_1 = $request -> insulin_type_1 ;
            $blood_sugar_detail -> insulin_value_1 = $request -> insulin_value_1 ;
            $blood_sugar_detail -> insulin_type_2 = $request -> insulin_type_2 ;
            $blood_sugar_detail -> insulin_value_2 = $request -> insulin_value_2 ;
            $blood_sugar_detail -> insulin_type_3 = $request -> insulin_type_3 ;
            $blood_sugar_detail -> insulin_value_3 = $request -> insulin_value_3 ;
            $blood_sugar_detail -> sugar = $request -> sugar ;
            $blood_sugar_detail -> note = $request -> note ;
            $blood_sugar_detail -> low_blood_sugar = $request -> low_blood_sugar ;
            $blood_sugar_detail -> blood_sugar_pk = $blood_sugar -> blood_sugar_pk;
            $blood_sugar_detail -> save();

            return "success";
        }
    }