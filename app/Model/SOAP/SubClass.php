<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/30
 * Time: 下午 11:18
 */

namespace App\Model\SOAP;
use Illuminate\Database\Eloquent\Model;

class SubClass extends Model
{
    protected $table = 'sub_class';

    protected $primaryKey = 'sub_class_pk';

    public function soa_class()
    {
        return $this->hasMany('App\Model\SOAP\SoaClass','sub_class_pk');
    }
}