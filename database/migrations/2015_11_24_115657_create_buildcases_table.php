<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildcases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personid', 50)->nullable();
            $table->integer('cardid')->unsigned()->nullable();
            $table->timestamp('build_at')->nullable();
            $table->integer('doctor')->unsigned()->nullable();
            $table->string('memo', 500)->nullable();
            $table->integer('duty')->unsigned()->nullable();
            $table->char('duty_status', 1)->nullable();
            $table->timestamp('duty_at')->nullable();
            $table->integer('nurse')->unsigned()->nullable();
            $table->string('soa_nurse_class_pks0', 100)->nullable();
            $table->char('nurse_status', 1)->nullable();
            $table->timestamp('nurse_at')->nullable();
            $table->integer('dietitian')->unsigned()->nullable();
            $table->string('soa_nurse_class_pks1', 100)->nullable();
            $table->char('dietitian_status', 1)->nullable();
            $table->timestamp('dietitian_at')->nullable();
            $table->char('hospital_no_uuid', 16)->nullable();
            $table->index('personid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buildcases');
    }
}
