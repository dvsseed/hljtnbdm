<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	// 职务
	public static $_position = array('院长' => '院长', '副院长' => '副院长', '病区主任' => '病区主任', '门诊医生' => '门诊医生', '住院医生' => '住院医生', '护理师' => '护理师', '营养师' => '营养师', '医助' => '医助', '' => '患者');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['account', 'name', 'password', 'departmentno', 'department', 'positionno', 'position', 'phone', 'email'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'is_admin'];

	/**
	 * grades表中的每行数据都有对应的一个用户
	 * @return [type] [description]
	 */
//	public function grade()
//	{
//		return $this->hasOne('App\Grade');
//	}

	/**
	 * 登录验证规则
	 * @return [type] [description]
	 */
	protected static function rules()
	{
		return [
			'account' => 'required|alpha_num',
			'password' => 'required'
		];
	}

	/**
	 *
	 * 一对多关联，一人「有很多」功能
	 */
	public function features()
	{
		return $this->hasMany('App\Hasfeature');
	}

	public function patientprofiles()
	{
		return $this->hasMany('App\Patientprofile');
	}

}
