<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patientprofile extends Model {

	protected $table = 'patientprofile1';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
	protected $fillable = ['pp_patientid', 'pp_personid', 'pp_name', 'pp_birthday', 'pp_age', 'pp_sex', 'pp_height', 'pp_weight', 'pp_tel1', 'pp_tel2', 'pp_mobile1', 'pp_mobile2', 'pp_area', 'pp_doctor', 'pp_remark', 'pp_source', 'pp_occupation', 'pp_address', 'pp_email'];

	protected $dates = ['pp_birthday'];

	public function setppbirthdayAttribute($date)
	{
		if (!empty($date)) $this->attributes['pp_birthday'] = Carbon::createFromFormat('Y-m-d', $date);
	}

	public function getppbirthdayAttribute($date)
	{
		if (is_null($date))
			$result = "";
		else
			$result = Carbon::parse($date)->toDateString(); // 1975-12-25
		return $result;
	}

  	/**
         * 登录验证规则
         * @return [type] [description]
         */
	protected static function rules()
        {
                return [
                        'pp_patientid' => 'required|unique:patientprofile1|digits:18',
			'pp_personid' => 'required|unique:patientprofile1|digits:18',
			'pp_name' => 'required',
			'pp_height' => 'required|numeric|min:0|max:200',
			'pp_weight' => 'required|numeric|min:0|max:200',
                        'pp_email' => 'required|email'
                ];
        }

        protected static function updaterules()
        {
               	return [
                       	'pp_name' => 'required',
                        'pp_height' => 'required|numeric|min:0|max:200',
                        'pp_weight' => 'required|numeric|min:0|max:200',
                       	'pp_email' => 'required|email'
                ];
        }

}
