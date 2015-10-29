<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    protected $table = 'features';

    protected $fillable = ['href', 'btnclass', 'innerhtml'];

    protected static function rules()
    {
        return [
            'href' => 'required',
            'btnclass' => 'required',
            'innerhtml' => 'required',
        ];
    }

    /**
     *
     * 一对多关联
     */
    public function hasfeatures()
    {
        return $this->hasMany('App\Hasfeature');
    }

    public function shows($id)
    {
        return Feature::find($id);
    }

}
