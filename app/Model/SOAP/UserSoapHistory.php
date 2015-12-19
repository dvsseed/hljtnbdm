<?php
/**
 * Created by PhpStorm.
 * User: purplebleed
 * Date: 2015/9/30
 * Time: 下午 11:18
 */

namespace App\Model\SOAP;
use Illuminate\Database\Eloquent\Model;

class UserSoapHistory extends Model
{
    protected $table = 'user_soap_history';

    protected $primaryKey = 'user_soap_history_pk';

    protected static function rules()
    {
        return [
            'trace_method' => 'numeric|min:0|max:7',
            'contact_time' => 'numeric|min:0|max:5'
        ];
    }
}