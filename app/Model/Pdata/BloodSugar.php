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
}
