<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasfeature extends Model {

        protected $table = 'hasfeatures';

        protected $fillable = ['user_id', 'feature_id'];

        protected static function rules()
        {
                return [
                        'user_id' => 'required',
                        'feature_id' => 'required',
                ];
        }

        /**
         *
         * 一对多关联
         */
        public function features()
        {
                return $this->belongsTo('App\Feature');
        }

}
