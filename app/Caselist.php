<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Caselist extends Model {

    protected $table = 'caselist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','pp_id','user_id','cl_case_date','cl_case_educator','cl_case_type','cl_base_sbp','cl_base_ebp','cl_pulse','cl_base_tall','cl_base_weight','cl_noweight','cl_ibw','cl_bmi','cl_waist','cl_hips','cl_blood_mne','cl_blood_ap','cl_blood_acpc','cl_blood_mins','cl_blood_hba1c','cl_tc','cl_tg','cl_ldl','cl_hdl','cl_alt','cl_ggt','cl_uricacid','cl_ua','cl_urine_micro','cl_upcr','cl_urine_routine','cl_egfr','cl_foot_chk_right','cl_foot_chk_left','cl_ulcers','cl_complications','cl_complications_stage','cl_complications_other','cl_intermittentpain','cl_abi','cl_abi_right_value','cl_abi_left_value','cl_cavi','cl_cavi_right_value','cl_cavi_left_value','cl_cavi_rkcavi','cl_eye_chk8','cl_eye_chk8_right_item','cl_eye_chk8_left_item','cl_cataract','cl_ecg','cl_ecg_other','cl_coronary_heart','cl_coronary_heart_other','cl_chh_year','cl_chh_month','cl_stroke','cl_stroke_item','cl_stroke_other','cl_sh_year','cl_sh_month','cl_blindness','cl_blindness_right_item','cl_blindness_left_item','cl_bh_year','cl_bh_month','cl_dialysis','cl_dialysis_item','cl_dh_year','cl_dh_month','cl_amputation','cl_amputation_right_item','cl_amputation_left_item','cl_ah_year','cl_ah_month','cl_amputation_other','cl_medical_treatment','cl_medical_treatment_other','cl_medical_treatment_emergency','cl_drinking','cl_drinking_other','cl_smoking','cl_havesmoke','cl_quitsmoke','cl_periodontal','cl_masticatory','cl_ultrasound','cl_ultrasound01','cl_ultrasound02','cl_ultrasound03','cl_ultrasound04','cl_ultrasound05','cl_ultrasound06','cl_ultrasound07'];

}
