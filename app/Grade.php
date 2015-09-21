<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

	protected $table = 'grades';

    protected $fillable = ['math', 'english', 'c', 'sport', 'think', 'soft'];

    protected static function rules(){
        return [
            'math' => 'digits_between:0,2',
            'english' => 'digits_between:0,2',
            'c' => 'digits_between:01,2',
            'sport' => 'digits_between:1,2',
            'think' => 'digits_between:1,2',
            'soft' => 'digits_between:1,2',
            ];
    }

}
