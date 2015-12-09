<?php namespace App\Model\Pdata;

/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/24
 * Time: 上午 01:30
 */

use Illuminate\Database\Eloquent\Model;

class BloodSugar extends Model
{
    protected $table = 'blood_sugar';

    protected $primaryKey = 'blood_sugar_pk';

    protected $fillable = ['calendar_date'];

    public function blood_sugar_detail()
    {
        return $this->hasMany('App\Model\Pdata\BloodSugarDetail','blood_sugar_pk');
    }

    public function history_soap()
    {
        return $this->hasOne('App\Model\SOAP\UserSoapHistory','blood_sugar_pk')->where('is_visible', '=', '1')->where('user_id', '=', \Auth::user()->id);
    }

    public function histories()
    {
        return $this->hasMany('App\Model\SOAP\UserSoapHistory','blood_sugar_pk');
    }
}
