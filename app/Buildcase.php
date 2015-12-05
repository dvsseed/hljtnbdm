<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Buildcase extends Model {
    public $timestamps = false;
    protected $table = 'buildcases';

    protected $fillable = ['id', 'personid', 'cardid', 'build_at', 'doctor', 'duty', 'duty_status', 'duty_at', 'nurse', 'nurse_status', 'nurse_at', 'dietitian', 'dietitian_status', 'dietitian_at'];

    protected static function rules()
    {
        return [
        ];
    }

}
