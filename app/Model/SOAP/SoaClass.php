<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/30
 * Time: 下午 11:18
 */

namespace App\Model\SOAP;
use Illuminate\Database\Eloquent\Model;

class SoaClass extends Model
{
    protected $table = 'soa_class';

    protected $primaryKey = 'soa_class_pk';

    public function soa_detail()
    {
        return $this->hasMany('App\Model\SOAP\SoaDetail','soa_class_pk');
    }
}