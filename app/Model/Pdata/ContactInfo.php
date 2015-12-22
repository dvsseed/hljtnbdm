<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/30
 * Time: 下午 11:18
 */

namespace App\Model\Pdata;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_info';

    protected $primaryKey = 'contact_info_pk';

    protected static function rules()
    {
        return [
            'trace_method' => 'numeric|min:0|max:7',
            'contact_time' => 'numeric|min:0|max:5',
            'contact_phone' => 'regex:/^\d+$/',
            'contact_email' => 'regex:/^[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+$/'
        ];
    }
}