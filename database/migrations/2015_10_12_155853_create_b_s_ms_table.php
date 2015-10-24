<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBSMsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bsm', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('bm_name', 20)->nullable();
			$table->string('bm_model', 20)->nullable();
			$table->integer('bm_order')->nullable();
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
		Schema::drop('bsm');
	}

}
