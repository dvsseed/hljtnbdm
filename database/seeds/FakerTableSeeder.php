<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

class FakerTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');

        /* faker > events */
        /*
                        $faker = Faker::create();
                        foreach (range(1,50) as $index) {
                                DB::table('events')->insert([
                                        'tablename' => 'tests',
                                        'action' => 'test(测试)',
                                        'user_id' => 8000,
                        'created_at' => $faker->dateTimeThisYear,
                        'updated_at' => $faker->dateTimeThisYear,
                                ]);
                        }
        */

        /* 1. faker > users */
        /*
        // $faker = Faker::create();
        $faker = Faker::create('zh_CN');
        // $faker->addProvider(new Faker\Provider\zh_CN\Address($faker));
        foreach (range(1, 100000) as $index) {
            DB::table('users')->insert([
                //'account' => $faker->unique()->numberBetween(100000, 500000),
                'account' => $this->randNum(18),
                'name' => $faker->name,
                'password' => bcrypt('0000'),
                'position' => '营养师',
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisYear,
            ]);
        }
        */

        /* 2. faker > patientprofile1 */
        /*
//        foreach (range(1, 100000) as $index) {
        DB::disableQueryLog();
        $urs = DB::select('select id,account,name from users where id > 7');
        $faker = Faker::create('zh_CN');
        foreach ($urs as $ur) {
            DB::table('patientprofile1')->insert([
                'user_id' => $ur->id,
                'pp_groupid' => 'C0001',
                'pp_patientid' => $pid = $ur->account,
                'pp_personid' => $pid,
                'pp_name' => $ur->name,
                'pp_birthday' => rand(0, 1) ? $faker->dateTimeBetween('-40 years', '-18 years') : null,
                'pp_age' => rand(10, 90),
                'pp_sex' => $faker->randomElement([0, 1]),
                'pp_height' => rand(100, 190),
                'pp_weight' => rand(45, 95),
                'pp_tel1' => $faker->phoneNumber,
                'pp_mobile1' => rand(0, 1) ? $faker->phoneNumber : '',
                'pp_area' => -1,
                'pp_doctor' => -1,
                'pp_source' => -1,
                'pp_occupation' => -1,
                'pp_address' => $faker->address,
                'pp_email' => $faker->email,
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisYear,
            ]);
        }
        */

        /* 3. faker > casecare */
        /*
        DB::disableQueryLog();
        // ini_set('memory_limit', '256M');
        $pps = DB::select('select id,pp_patientid from patientprofile1');
        $faker = Faker::create('zh_CN');
        foreach ($pps as $pp) {
            DB::table('casecare')->insert([
                'patientprofile1_id' => $pp->id,
                'cc_patientid' => $pp->pp_patientid,
                'cc_language' => 0,
                'cc_mdate' => -1,
                'cc_mdatem' => -1,
                'cc_type' => 2,
                'cc_ibw' => $faker->randomFloat(10, 90),
                'cc_bmi' => $faker->randomFloat(10, 90),
                'cc_waist' => 0.00,
                'cc_butt' => 0.00,
                'cc_drink' => 0,
                'cc_wineq' => 0,
                'cc_smoke' => 0,
                'cc_fh' => 0,
                'cc_drug_allergy' => 0,
                'cc_activity' => 1,
                'cc_medicaretype' => 1,
                'cc_jobtime' => 1,
                'cc_current_use' => '000000',
                'cc_starty' => -1,
                'cc_startm' => -1,
                'cc_hinder' => '0000000000',
                'cc_act_time' => 0,
                'cc_edu' => 6,
                'cc_careself' => 1,
                'cc_usebsm' => 0,
                'cc_usebsm_frq' => 0,
                'cc_usebsm_unit' => 0,
                'cc_g6pd' => 0,
                'cc_deathdate' => -1,
                'cc_deathdatem' => -1,
                'cc_smartphone' => 1,
                'cc_wifi3g' => 2,
                'cc_smartphone_family' => 1,
                'cc_familyupload' => 1,
                'cc_uploadtodm' => 1,
                'cc_appexp' => 1,
                'cc_lastexam' => 1,
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisYear,
            ]);
        }
        */

    }

    public function randNum($len)
    {
        $str = mt_rand(1, 9);
        for ($i = 1; $i < $len; $i++) {
            $str .= mt_rand(0, 9);
        }
        return $str;
    }
}
