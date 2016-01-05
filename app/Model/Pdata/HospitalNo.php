<?php namespace  App\Model\Pdata;

use Illuminate\Database\Eloquent\Model;
use App\Model\Pdata\Hba1cGoal;

class HospitalNo extends Model
{
    protected $table = 'hospital_no';

    protected $primaryKey = 'hospital_no_uuid';

    public function blood_sugar()
    {
        return $this->hasMany('App\Model\Pdata\BloodSugar','hospital_no_uuid');
    }

    public function food_record()
    {
        return $this->hasMany('App\Model\Pdata\UserFood','hospital_no_uuid');
    }

    public function messages()
    {
        return $this->hasMany('App\Model\Pdata\Message','hospital_no_uuid');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patientprofile', 'patient_profile_id');
    }

    public function user_soap()
    {
        return $this->hasOne('App\Model\SOAP\UserSoap', 'hospital_no_uuid');
    }

    public function contact_info()
    {
        return $this->hasOne('App\Model\Pdata\ContactInfo', 'hospital_no_uuid');
    }

    public function hba1c_goal_matrix()
    {
        return Hba1cGoal::find($this->hba1c_goal);
    }

}
