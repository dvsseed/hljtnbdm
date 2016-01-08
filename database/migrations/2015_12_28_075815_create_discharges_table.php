<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pp_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('doctor')->unsigned()->nullable();
            $table->integer('residencies')->unsigned()->nullable();
            $table->string('instruction', 2000)->nullable();
            $table->char('discharge_at', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discharges');
    }
}
