<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BSM extends Model {

	protected $table = 'bsm';

        protected $fillable = ['bm_name', 'bm_model', 'bm_order'];

}
