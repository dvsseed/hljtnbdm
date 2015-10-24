<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 9/28/2015
 * Time: 11:48 AM
 */

namespace App\Model\Pdata;

use Illuminate\Database\Eloquent\Model;

class BloodSugarDetail extends Model
{
    protected $table = 'blood_sugar_detail';

    protected $primaryKey = 'blood_sugar_detail_pk';

    protected static function rules()
    {
        return [
            'measure_time' => 'required|date_format:Y-m-d h:i',
            'measure_type' => 'required',
            'exercise_type' => 'in:slight,medium,heavy',
            'exercise_duration' => 'numeric|min:0',
            'insulin_type_1' => 'numeric|min:0',
            'insulin_value_1' => 'numeric|min:0',
            'insulin_type_2' => 'numeric|min:0',
            'insulin_value_2' => 'numeric|min:0',
            'insulin_type_3' => 'numeric|min:0',
            'insulin_value_3' => 'numeric|min:0',
            'sugar' => 'numeric|min:0'
        ];
    }
}