<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseCare extends Model
{

    protected $table = 'casecare';

    protected $fillable = ['patientprofile1_id', 'cc_patientid', 'cc_contactor', 'cc_contactor_tel', 'cc_language', 'cc_mdate', 'cc_mdatem', 'cc_type', 'cc_type_other', 'cc_ibw', 'cc_bmi', 'cc_waist', 'cc_butt', 'cc_status', 'cc_status_other', 'cc_drink', 'cc_wine', 'cc_wineq', 'cc_smoke', 'cc_mh', 'cc_fh', 'cc_fh_desc', 'cc_drug_allergy', 'cc_drug_allergy_name', 'cc_activity', 'cc_medicaretype', 'cc_jobtime', 'cc_current_use', 'cc_starty', 'cc_startm', 'cc_hinder', 'cc_hinder_desc', 'cc_act_time', 'cc_act_kind', 'cc_edu', 'cc_careself', 'cc_careself_name', 'cc_careman', 'cc_careman_tel', 'cc_usebsm', 'cc_usebsm_frq', 'cc_usebsm_unit', 'cc_g6pd', 'cc_deathdate', 'cc_deathdatem', 'cc_smartphone', 'cc_wifi3g', 'cc_smartphone_family', 'cc_familyupload', 'cc_uploadtodm', 'cc_appexp', 'cc_lastexam'];

    protected static function rules()
    {
        return [
        ];
    }

    /**
     *
     * 一对一关联
     */
    public function bsms()
    {
        return $this->hasMany('App\BSM');
    }

}
