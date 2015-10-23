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
	protected $fillable = ['pp_patientid', 'pp_name', 'pp_birthday', 'pp_sex', 'pp_height', 'pp_weight', 'pp_tel1', 'pp_tel2', 'pp_mobile1', 'pp_mobile2', 'pp_address', 'pp_email', 'pp_personid'];

	protected $dates = ['pp_birthday'];

	public function setppbirthdayAttribute($date)
	{
		$this->attributes['pp_birthday'] = Carbon::createFromFormat('Y-m-d', $date);
	}

	public function getppbirthdayAttribute($date)
	{
		return Carbon::parse($date)->toDateString(); // 1975-12-25
	}

}
