<?php namespace  App\Model\Pdata;

use Illuminate\Database\Eloquent\Model;

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
}
