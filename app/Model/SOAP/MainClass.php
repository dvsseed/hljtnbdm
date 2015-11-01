<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 11/1/2015
 * Time: 3:16 PM
 */

namespace App\Model\SOAP;


use Illuminate\Database\Eloquent\Model;

class MainClass extends Model
{
    protected $table = 'main_class';

    protected $primaryKey = 'main_class_pk';

    public function sub_class()
    {
        return $this->hasMany('App\Model\SOAP\SubClass','main_class_pk');
    }
}