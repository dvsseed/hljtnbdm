<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEducatorToPatientprofile1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patientprofile1', function (Blueprint $table) {
            $table->string('educator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patientprofile1', function (Blueprint $table) {
            $table->dropColumn('educator');
        });
    }
}
