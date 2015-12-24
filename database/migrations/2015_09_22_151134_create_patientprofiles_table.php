<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientprofilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patientprofile1', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('pp_groupid', 5)->default('C0001');
            $table->string('pp_patientid', 50)->unique();
            $table->string('pp_name', 50)->nullable();
            $table->dateTime('pp_birthday')->nullable();
            $table->integer('pp_age')->unsigned()->nullable();
            $table->char('pp_sex', 1)->nullable();
            $table->decimal('pp_height',4,1)->nullable();
            $table->decimal('pp_weight',4,1)->nullable();
            $table->string('pp_tel1', 20)->default(' ');
            $table->string('pp_tel2', 20)->default(' ');
            $table->string('pp_mobile1', 20)->default(' ');
            $table->string('pp_mobile2', 20)->default(' ');
            $table->char('pp_area', 2)->nullable();
            $table->string('pp_area_other', 20)->nullable();
            $table->char('pp_doctor', 2)->nullable();
            $table->string('pp_remark', 100)->nullable();
            $table->char('pp_source', 2)->nullable();
            $table->string('pp_source_other', 20)->nullable();
            $table->char('pp_occupation', 2)->nullable();
            $table->string('pp_occupation_other', 20)->nullable();
            $table->string('pp_address', 100)->nullable();
            $table->string('pp_email', 100)->nullable();
            $table->timestamps();
            $table->string('educator', 50)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pp_patientid')->references('account')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        Schema::drop('patientprofile1');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // disable foreign key constraints
    }

}
