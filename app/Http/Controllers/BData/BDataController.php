<?php namespace App\Http\Controllers\BData;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/21
 * Time: �U�� 09:36
 */

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Pdata\FoodCategory;
use App\Model\Pdata\Food;
use App\Model\Pdata\Message;
use App\Model\Pdata\UserFood;
use App\Model\Pdata\UserFoodDetail;
use Illuminate\Http\Request;
use App\Model\Pdata\BloodSugar;
use App\Model\Pdata\BloodSugarDetail;
use App\Model\Pdata\HospitalNo;
use App\User;
use Session;
use Auth;
use Cache;
use Input;


    class BDataController extends Controller{

        public function __construct()
        {
            $this->middleware('auth');
        }

        public function page( $uuid = null, $end = null)
        {

            $users = Auth::user();

            if($uuid == null){
                $hospital_no = HospitalNo::where('patient_user_id', '=', $users->id) -> first();
                if($hospital_no != null){
                    $uuid = $hospital_no -> hospital_no_uuid;
                }else{
                    $err_msg = '沒有血糖資料!';
                }
            }else{
                $hospital_no = HospitalNo::find($uuid);
                if($hospital_no != null){
                    $hospital_no = $hospital_no->where('patient_user_id', '=', $users->id)->orWhere('nurse_user_id', '=', $users->id)->first();
                }
                if($hospital_no == null){
                    $err_msg = '您沒有權限查看此血糖資料!';
                }
            }

            if($hospital_no == null){
                return view('bdata.error', compact('err_msg'));
            }

            if($end > date('Y-m-d')){
                return redirect('/bdata/'.$uuid);
            }

            if($end == null){
                $data['next'] = null;
                $end = date('Y-m-d');
            }else{
                $next = date('Y-m-d',strtotime("2 week", strtotime($end)));
                if($end == date('Y-m-d')){
                    $data['next'] = null;
                }
                else if($next == date('Y-m-d')){
                    $data['next'] = "/bdata/".$uuid;
                }else{
                    $data['next'] = "/bdata/".$uuid."/".$next;
                }
            }

            $start = date('Y-m-d', strtotime("-2 week", strtotime($end)));
            $data['previous'] = "/bdata/".$uuid."/".$start;


            if($hospital_no->count() ==0 ) {
                $invalid = true;
                return view('bdata.bdata', compact('invalid'));
            }
            $hospital_no = $hospital_no->first();

            $data['displayname'] = $hospital_no->hospital_no_displayname;
            $data['patient_displayname'] = User::find($hospital_no->patient_user_id)->name;

            $blood_records = $hospital_no->blood_sugar()->where('calendar_date', '<=', $end)->where('calendar_date', '>', $start)->orderBy('calendar_date', 'DESC')->get();
            $stat = $this -> get_stat($blood_records);
            $blood_records = $this->fillup($blood_records,$start,$end);

            $data['food_categories'] = FoodCategory::all();

            $food_records = $this->get_has_food($uuid);
            Session::put('blood_records', $blood_records);
            Session::put('uuid', $uuid);

            return view('bdata.bdata', compact('blood_records', 'data', 'food_categories', 'stat', 'food_records'));
        }

        private function get_has_food($uuid){
            $calendar_date = date('Y-m-d');
            $start = date('Y-m-d', strtotime("-2 week", strtotime($calendar_date)));
            $records = HospitalNo::find($uuid)->food_record()->where('calendar_date','<=',$calendar_date)-> where('calendar_date','>',$start)->get();

            $food_all_calendar = array();
            foreach($records as $record){
                if(isset($food_all_calendar[$record['calendar_date']])){
                    array_push($food_all_calendar, $record['measure_type']);
                }else{
                    $food_all_calendar[$record['calendar_date']] = [$record['measure_type']];
                }
            }

            return $food_all_calendar;
        }

        public function get_food_stat(){
            $uuid = Session::get('uuid');
            $calendar_date = date('Y-m-d');
            $start = date('Y-m-d', strtotime("-2 month", strtotime($calendar_date)));

            $records = HospitalNo::find($uuid)->food_record()->where('calendar_date','<=',$calendar_date)-> where('calendar_date','>',$start)->get();

            $food_tmp = array();

            foreach($records as $record){
                if(isset($food_tmp[$record['measure_type']])){
                    array_push($food_tmp[$record['measure_type']],$record['sugar_amount']);
                }else{
                    $food_tmp[$record['measure_type']] = [$record['sugar_amount']];
                }
            }

            $food_stat = array();
            foreach($food_tmp as $key => $food_array){
                $food_stat[$key]["count"] = count($food_array);
                $food_stat[$key]["average"] = round($this->average($food_array));
                $food_stat[$key]["max"] = max($food_array);
                $food_stat[$key]["min"] = min($food_array);
                $food_stat[$key]["above"] = "0 (0%)";
                $food_stat[$key]["normal"] = count($food_array)." (100%)";
                $food_stat[$key]["below"] = "0 (0%)";
            }

            return view('bdata.food_statics', compact('food_stat'));
        }

        private function get_stat($blood_records){

            $nodes = ['early_morning', 'morning', 'breakfast_before', 'breakfast_after', 'lunch_before', 'lunch_after', 'dinner_before', 'dinner_after', 'sleep_before'];
            $stat['avg'] = array();
            $stat['deviation'] = array();
            $counter = 0;
            foreach($nodes as $node){
                $tmp_arr = [];
                foreach($blood_records as $blood_record){
                    if($blood_record[$node] != null){
                        $counter ++;
                    }
                    if($blood_record[$node] != null)
                        array_push($tmp_arr,$blood_record[$node]);
                }

                if(count($blood_records) != 0){
                    $stat['avg'][$node] = ($this -> average($tmp_arr));
                    $stat['deviation'][$node] = round($this -> deviation($tmp_arr, $stat['avg'][$node]));
                    $stat['avg'][$node] = round($stat['avg'][$node]);
                }
                else{
                    $stat['deviation'][$node] = 0.0;
                    $stat['avg'][$node] = 0.0;
                }
            }
            $stat['total'] = $counter;
            return $stat;
        }

        private function average($arr){
            if(count($arr) == 0)
                return 0.0;
            else{
                return array_sum($arr)/count($arr);
            }
        }

        private function deviation($arr,$avg){
            if(count($arr) <= 1){
                return 0.0;
            }
            $sqr = 0.0;
            foreach($arr as $ar){
                $sqr += (($ar - $avg) * ($ar - $avg));
            }

            $sqr /= (count($arr)-1);

            return sqrt($sqr);
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
                    $bsugar->dinner_before = null;
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
            $hospital_no = HospitalNo::find($uuid);

            $blood_sugar = $hospital_no->blood_sugar()->firstOrNew(array('calendar_date' => $request->calendar_date));
            $blood_sugar -> calendar_date = $request -> calendar_date;
            $blood_sugar[$request->measure_type] = $request -> blood_sugar;
            $blood_sugar -> user_id = $hospital_no-> patient_user_id;
            $blood_sugar -> note = $request -> note;
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

        public function upsertfood(Request $request){
            $uuid = Session::get('uuid');
            $hospital_no = HospitalNo::find($uuid);

            $food_record = $hospital_no->food_record()->firstOrNew(array('calendar_date' => $request->calendar_date));
            $food_record -> calendar_date = $request -> calendar_date;
            $food_record -> measure_type= $request -> type;
            $food_record -> user_id = $hospital_no -> patient_user_id;
            $food_record -> sugar_amount = $request -> sugar_amount;
            $food_record -> food_note = $request -> food_note;
            $food_record -> note = $request -> overall_note;
            $food_record -> food_time = date('Y-m-d H:i', strtotime($request -> food_time));
            $food_record -> save();

            //delete old
            $food_record -> food_detail() -> delete();

            if($request -> details != null){
                //rule check
                foreach($request -> details as $detail){
                    $user_food_detail = new UserFoodDetail();
                    $user_food_detail -> food_pk = $detail['food_type_option'];
                    if($detail['food_unit'] == "gram")
                        $user_food_detail -> amount_gram = $detail['amount'];
                    elseif($detail['food_unit'] == "set"){
                        $user_food_detail -> amount_set = $detail['amount'];
                    }
                    $user_food_detail -> food_category_pk = $detail['food_category'];
                    $user_food_detail -> user_food_pk = $food_record -> user_food_pk;
                    $user_food_detail -> save();
                }
            }

            return "success";
        }

        public function get_food_detail( $calendar_date, $measure_type){
            $user_food = array();
            $uuid = Session::get('uuid');

            $user_food['summary'] = HospitalNo::find($uuid)->food_record()->where('calendar_date','=',$calendar_date)->where('measure_type','=',$measure_type)->get()->first();
            if($user_food['summary'] != null){
                $user_food['detail'] = $user_food['summary']->food_detail;
                if($user_food['detail'] != null){
                    foreach($user_food['detail'] as $detail){
                        $food = Food::find($detail -> food_pk);
                        $detail -> food_name = $food -> food_name;
                        $detail -> food_category_name = FoodCategory::find($detail -> food_category_pk) -> food_category_name;
                        if($detail -> amount_gram != null){
                            $detail -> sugar = $food -> gram_sugar_value * $detail -> amount_gram ;
                        }
                        else if($detail -> amount_set != null){
                            $detail -> sugar = $food -> set_sugar_value * $detail -> amount_set;
                        }
                    }
                }
            }

            return $user_food;
        }

        public function get_food_category($food_category_id){
            $all_food = array();//Cache::get('foods');

            if(isset($all_food)){
                if(!isset($all_food[$food_category_id])){
                    $all_food[$food_category_id] = Food::where('food_category_pk','=',$food_category_id)->get();
                }
            }else{
                $all_food = array();
                $all_food[$food_category_id] = Food::where('food_category_pk','=',$food_category_id)->get();
            }
            Cache::forever('foods',$all_food);
            $foods = $all_food[$food_category_id];

            return $foods;
        }

        public function message(){
            $uuid = Session::get('uuid');
            $hospital_no = HospitalNo::find($uuid);

            $user = array();
            $user[$hospital_no-> pateint_user_id] = User::find($hospital_no-> patient_user_id) -> name;
            $user[$hospital_no-> nurse_user_id] =  User::find($hospital_no-> nurse_user_id) -> name ;

            $start = Input::get('start');
            if($start != null && is_numeric($start)){
                $messages = $hospital_no->messages()-> orderBy('message_pk','desc')-> skip($start) -> take(20)->get();
            }else{
                $messages = $hospital_no->messages()-> orderBy('message_pk','desc') ->take(20)->get();
            }

            return view('bdata.messagetemplate', compact('messages', 'user'));
        }

        public function post_message(Request $request){
            $uuid = Session::get('uuid');
            $user_id = Auth::user()->id;

            $message = new Message();
            $message -> hospital_no_uuid = $uuid;
            $message -> sender_id = $user_id;
            $message -> message = $request->message_body;
            $message -> save();

            return "success";

        }

        public function batch_update(Request $request){
            $sugar_data = $request['sugar_data'];
            $uuid = Session::get('uuid');
            $hospital_no = HospitalNo::find($uuid);
            $user_id = $hospital_no->patient_user_id;

            foreach($sugar_data as $one_data){
                $calendar_date = $one_data['calendar_date'];
                if(count(array_keys($one_data)) == 1){
                    $blood_sugar_data = $hospital_no->blood_sugar()->where('calendar_date', '=' , $calendar_date) ->first();
                    if($blood_sugar_data !=null ){
                        $details = $blood_sugar_data -> blood_sugar_detail;
                        foreach( $details as $detail){
                            $detail -> delete();
                        }
                        $blood_sugar_data -> delete();
                    }
                }
                else{
                    $blood_sugar = HospitalNo::find($uuid)->blood_sugar()->firstOrNew(array('calendar_date' => $calendar_date));
                    foreach( $one_data as $key => $value){
                        $blood_sugar[$key] = $value;
                    }
                    $blood_sugar -> calendar_date = $calendar_date;
                    $blood_sugar -> user_id = $user_id;
                    $blood_sugar -> save();
                }
            }

            return "success";
        }

        public function delete_food($calendar_date){

            $uuid = Session::get('uuid');
            $user_food = HospitalNo::find($uuid) -> food_record() -> where('calendar_date', '=', $calendar_date) -> first();

            if($user_food != null){
                $details = $user_food -> food_detail;
                foreach( $details as $detail){
                    $detail -> delete();
                }
                $user_food -> delete();
            }

            return "success";
        }
    }
