<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseCaresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('casecare', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('patientprofile1_id')->unsigned();
			$table->char('cc_patientid', 20)->nullable();
			$table->string('cc_educator', 20)->nullable();
			$table->string('cc_contactor', 50)->nullable();
			$table->string('cc_contactor_tel', 20)->nullable();
			$table->char('cc_language', 2)->nullable();
			$table->integer('cc_mdate')->nullable();
			$table->integer('cc_mdatem')->nullable();
			$table->integer('cc_type')->unsigned()->default(2);
			$table->float('cc_ibw')->nullable();
			$table->float('cc_bmi')->nullable();
			$table->float('cc_waist')->nullable();
			$table->float('cc_butt')->nullable();
			$table->string('cc_status', 10)->nullable();
                        $table->string('cc_status_other', 20)->nullable();
			$table->integer('cc_drink')->unsigned()->nullable();
			$table->string('cc_wine', 20)->nullable();
			$table->integer('cc_wineq')->nullable();
			$table->integer('cc_smoke')->nullable();
			$table->string('cc_mh', 20)->nullable();
			$table->integer('cc_fh')->unsigned()->nullable();
			$table->string('cc_fh_desc', 20)->nullable();
			$table->integer('cc_drug_allergy')->unsigned()->nullable();
			$table->string('cc_drug_allergy_name', 20)->nullable();
			$table->integer('cc_activity')->unsigned()->nullable();
			$table->integer('cc_medicaretype')->unsigned()->nullable();
			$table->integer('cc_jobtime')->unsigned()->nullable();
			$table->char('cc_current_use', 6)->nullable();
			$table->integer('cc_starty')->nullable();
			$table->integer('cc_startm')->nullable();
			$table->char('cc_hinder', 10)->nullable();
			$table->string('cc_hinder_desc', 20)->nullable();
			$table->integer('cc_act_time')->nullable();
			$table->char('cc_act_kind', 10)->nullable();
			$table->integer('cc_edu')->unsigned()->nullable();
			$table->integer('cc_careself')->unsigned()->nullable();
			$table->string('cc_careself_name', 20)->nullable();
			$table->string('cc_careman', 20)->nullable();
			$table->string('cc_careman_tel', 15)->nullable();
			$table->integer('cc_usebsm')->nullable();
			$table->integer('cc_usebsm_frq')->nullable();
			$table->integer('cc_usebsm_unit')->nullable();
			$table->integer('cc_g6pd')->unsigned()->default(0);
			$table->integer('cc_deathdate')->nullable();
			$table->integer('cc_deathdatem')->nullable();
			$table->integer('cc_smartphone')->unsigned()->nullable();
			$table->integer('cc_wifi3g')->unsigned()->nullable();
			$table->integer('cc_smartphone_family')->unsigned()->nullable();
			$table->integer('cc_familyupload')->unsigned()->nullable();
			$table->integer('cc_uploadtodm')->unsigned()->nullable();
			$table->integer('cc_appexp')->unsigned()->nullable();
			$table->integer('cc_lastexam')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('casecare');
	}

}
