<?php namespace App\Http\Controllers\BData;
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/21
 * Time: �U�� 09:36
 */

use App\Http\Controllers\Controller;
use App\Model\Pdata\BloodSugar;

    class BDataController extends Controller{

        public function page($end = null)
        {
            if($end == null)
                $end = date('Y-m-d');
            $start = date('Y-m-d', strtotime("-2 week", strtotime($end)));

            $blood_records = BloodSugar::where('calendar_date', '<=', $end) -> where('calendar_date', '>=', $start) -> orderBy('calendar_date', 'DESC') ->get();
            $blood_records = $this->fillup($blood_records,$start,$end);
            return view('bdata.bdata', compact('blood_records'));
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
    }