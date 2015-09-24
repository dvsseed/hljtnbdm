<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientprofilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patientprofile1', function(Blueprint $table) {
			$table->increments('id');
			$table->string('pp_groupid', 5)->default('C0001');
			$table->string('pp_patientid', 20)->nullable();
			$table->string('pp_name', 20)->nullable();
			$table->dateTime('pp_birthday')->nullable();
			$table->char('pp_sex', 1)->nullable();
			$table->float('pp_height')->nullable();
			$table->float('pp_weight')->nullable();
			$table->string('pp_tel1', 20)->default(' ');
			$table->string('pp_tel2', 20)->default(' ');
			$table->string('pp_mobile1', 20)->default(' ');
			$table->string('pp_mobile2', 20)->default(' ');
			$table->string('pp_address', 100)->nullable();
			$table->string('pp_email', 100)->nullable();
			$table->string('pp_personid', 20)->nullable();
			$table->dateTime('pp_lastdate')->nullable();
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
		Schema::drop('patientprofile1');
	}

}
