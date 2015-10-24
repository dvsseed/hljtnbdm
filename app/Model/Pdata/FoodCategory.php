<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/30
 * Time: 下午 11:08
 */

namespace App\Model\Pdata;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $table = 'food_category';

    protected $primaryKey = 'food_category_pk';

    public function foods()
    {
        return $this->hasMany('App\Model\Pdata\Food','food_category_pk');
    }
}