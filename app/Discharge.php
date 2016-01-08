<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Discharge extends Model {
    public $timestamps = false;
    protected $table = 'discharges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'pp_id', 'user_id', 'doctor', 'residencies', 'instruction', 'discharge_at'];
}
