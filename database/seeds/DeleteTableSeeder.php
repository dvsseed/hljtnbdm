<?php

use Illuminate\Database\Seeder;

class DeleteTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('blood_sugar')->truncate();
        DB::table('blood_sugar_detail')->truncate();
        DB::table('buildcases')->truncate();
        DB::table('casecare')->truncate();
        DB::table('caselist')->truncate();
        DB::table('contact_info')->truncate();
        DB::table('events')->truncate();
        DB::table('hasfeatures')->truncate();
        DB::table('hospital_no')->truncate();
        DB::table('message')->truncate();
        DB::table('patientprofile1')->truncate();
        DB::table('user_customize')->truncate();
        DB::table('user_food')->truncate();
        DB::table('user_food_detail')->truncate();
        DB::table('user_soap')->truncate();
        DB::table('user_soap_history')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
