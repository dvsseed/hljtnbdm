<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaselistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caselist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pp_id')->unsigned();
            $table->char('cl_case_date', 10)->nullable();
            $table->string('cl_case_educator', 5)->nullable();
            $table->string('cl_case_type', 12)->nullable();
            $table->string('cl_patientname', 5)->nullable();
            $table->char('cl_patientid', 18)->nullable();
            $table->decimal('cl_base_sbp',3,0)->unsigned()->nullable();
            $table->decimal('cl_base_ebp',3,0)->unsigned()->nullable();
            $table->decimal('cl_pulse',3,0)->unsigned()->nullable();
            $table->decimal('cl_base_tall',5,1)->unsigned()->nullable();
            $table->decimal('cl_base_weight',5,1)->unsigned()->nullable();
            $table->char('cl_noweight',1)->nullable();
            $table->decimal('cl_ibw',3,1)->unsigned()->nullable();
            $table->decimal('cl_bmi',4,1)->unsigned()->nullable();
            $table->decimal('cl_waist',5,1)->unsigned()->nullable();
            $table->decimal('cl_hips',5,1)->unsigned()->nullable();
            $table->char('cl_blood_mne',2)->nullable();
            $table->char('cl_blood_ap',1)->nullable();
            $table->decimal('cl_blood_acpc',3,0)->unsigned()->nullable();
            $table->decimal('cl_blood_mins',3,0)->unsigned()->nullable();
            $table->decimal('cl_blood_hba1c',4,1)->unsigned()->nullable();
            $table->decimal('cl_tc',4,2)->unsigned()->nullable();
            $table->decimal('cl_tg',4,2)->unsigned()->nullable();
            $table->decimal('cl_ldl',4,2)->unsigned()->nullable();
            $table->decimal('cl_hdl',4,2)->unsigned()->nullable();
            $table->decimal('cl_alt',2,0)->unsigned()->nullable();
            $table->decimal('cl_ggt',2,0)->unsigned()->nullable();
            $table->decimal('cl_uricacid',2,0)->unsigned()->nullable();
            $table->decimal('cl_ua',3,0)->unsigned()->nullable();
            $table->decimal('cl_urine_micro',2,0)->unsigned()->nullable();
            $table->char('cl_urine_routine',2)->nullable();
            $table->decimal('cl_egfr',3,0)->unsigned()->nullable();
            $table->char('cl_foot_chk_right',6)->nullable();
            $table->char('cl_foot_chk_left',6)->nullable();
            $table->char('cl_ulcers',3)->nullable();
            $table->char('cl_complications',3)->nullable();
            $table->char('cl_complications_stage',3)->nullable();
            $table->string('cl_complications_other',10)->nullable();
            $table->char('cl_intermittentpain',4)->nullable();
            $table->char('cl_abi',3)->nullable();
            $table->decimal('cl_abi_right_value',4,2)->unsigned()->nullable();
            $table->decimal('cl_abi_left_value',4,2)->unsigned()->nullable();
            $table->char('cl_cavi',3)->nullable();
            $table->decimal('cl_cavi_right_value',4,1)->unsigned()->nullable();
            $table->decimal('cl_cavi_left_value',4,1)->unsigned()->nullable();
            $table->decimal('cl_cavi_rkcavi',4,1)->unsigned()->nullable();
            $table->char('cl_eye_chk8',4)->nullable();
            $table->char('cl_eye_chk8_right_item',3)->nullable();
            $table->char('cl_eye_chk8_left_item',3)->nullable();
            $table->char('cl_cataract',4)->nullable();
            $table->char('cl_ecg',2)->nullable();
            $table->string('cl_ecg_other',10)->nullable();
            $table->char('cl_coronary_heart',1)->nullable();
            $table->string('cl_coronary_heart_other',10)->nullable();
            $table->char('cl_chh_year',4)->unsigned()->nullable();
            $table->char('cl_chh_month',2)->nullable();
            $table->char('cl_stroke',1)->nullable();
            $table->char('cl_stroke_item',3)->nullable();
            $table->string('cl_stroke_other',10)->nullable();
            $table->char('cl_sh_year',4)->unsigned()->nullable();
            $table->char('cl_sh_month',2)->nullable();
            $table->char('cl_blindness',3)->nullable();
            $table->char('cl_blindness_right_item',3)->nullable();
            $table->char('cl_blindness_left_item',3)->nullable();
            $table->char('cl_bh_year',4)->unsigned()->nullable();
            $table->char('cl_bh_month',2)->nullable();
            $table->char('cl_dialysis',1)->nullable();
            $table->char('cl_dialysis_item',3)->nullable();
            $table->char('cl_dh_year',4)->unsigned()->nullable();
            $table->char('cl_dh_month',2)->nullable();
            $table->char('cl_amputation',3)->nullable();
            $table->char('cl_amputation_right_item',3)->nullable();
            $table->char('cl_amputation_left_item',3)->nullable();
            $table->char('cl_ah_year',4)->unsigned()->nullable();
            $table->char('cl_ah_month',2)->nullable();
            $table->string('cl_amputation_other',10)->nullable();
            $table->char('cl_medical_treatment',1)->nullable();
            $table->decimal('cl_medical_treatment_other',2,0)->unsigned()->nullable();
            $table->char('cl_medical_treatment_emergency',3)->nullable();
            $table->char('cl_drinking',1)->nullable();
            $table->decimal('cl_drinking_other',4,0)->unsigned()->nullable();
            $table->char('cl_smoking',3)->nullable();
            $table->string('cl_havesmoke',3)->nullable();
            $table->string('cl_quitsmoke',10)->nullable();
            $table->char('cl_periodontal',2)->nullable();
            $table->char('cl_masticatory',1)->nullable();
            $table->char('cl_ultrasound',8)->nullable();
            $table->string('cl_ultrasound01',20)->nullable();
            $table->string('cl_ultrasound02',20)->nullable();
            $table->string('cl_ultrasound03',20)->nullable();
            $table->string('cl_ultrasound04',20)->nullable();
            $table->string('cl_ultrasound05',20)->nullable();
            $table->string('cl_ultrasound06',20)->nullable();
            $table->string('cl_ultrasound07',20)->nullable();
            $table->timestamps();
            $table->index('cl_patientid');
            $table->foreign('pp_id')->references('id')->on('patientprofile1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('caselist');
    }
}
