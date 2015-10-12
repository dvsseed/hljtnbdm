<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/10/1
 * Time: 下午 09:43
 */

namespace App\Model\Pdata;

use Illuminate\Database\Eloquent\Model;

class UserFood extends Model
{
    protected $table = 'user_food';

    protected $primaryKey = 'user_food_pk';

    protected $fillable = ['calendar_date'];

    public function food_detail()
    {
        return $this->hasMany('App\Model\Pdata\UserFoodDetail','user_food_pk');
    }

}