<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id')->unique()->unsigned();
			$table->string('name');
			$table->string('password');
			$table->integer('departmentno')->default(0);
			$table->string('department')->default('');
			$table->integer('positionno')->default(0);
			$table->string('position')->default('');
                        $table->string('phone')->default('');
                        $table->string('email')->default('');
			$table->boolean('is_admin')->default(0);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
